<template>
    <div class="data-table-wrapper">
        <v-data-table-server density="comfortable" :disable-sort="disableSort" @update:options="updateOptionsCallback"
            :items="items" :items-length="itemsLength" v-model:items-per-page="itemsPerPage" :headers="computedHeaders"
            :loading="loading" :items-per-page-options="itemsPerPageOptions" :hover="hover" :search="searchValue"
            :class="tableClasses" :footer-props="footerProps" :item-class="itemClass" v-model:page="page"
            v-model:sort-by="sortBy" :show-select="showSelect" :single-select="singleSelect"
            :items-per-page-text="__('Items per page')">
            <template v-slot:top>
                <v-toolbar style="border-radius: 20px; padding: 8px 15px;" flat :color="toolbarColor"
                    class="data-table-toolbar flex !items-center">
                    <v-toolbar-title :class="['fw-semibold', '!text-2xl', '!m-2', titleClass]">{{ title
                    }}</v-toolbar-title>

                    <v-spacer></v-spacer>

                    <!-- Search Field -->
                    <v-text-field v-if="showSearch" v-model="searchValue" :placeholder="searchPlaceholder"
                        prepend-inner-icon="mdi-magnify" hide-details single-line density="compact"
                        class="data-table-search me-4" variant="outlined" clearable></v-text-field>

                    <!-- Filter Button -->
                    <v-menu v-if="hasFilter" v-model="filterMenu" :close-on-content-click="false">
                        <template v-slot:activator="{ props }">
                            <v-btn v-bind="props" color="grey-darken-1" variant="tonal" class="me-2 fw-medium"
                                prepend-icon="mdi-filter-variant">
                                {{ __('Filter') }}
                                <v-badge v-if="activeFilters > 0" :content="activeFilters.toString()" color="primary"
                                    inline></v-badge>
                            </v-btn>
                        </template>
                        <v-card min-width="300" class="pa-3">
                            <v-card-title class="pb-2">{{ __('Filter Options') }}</v-card-title>
                            <v-divider></v-divider>
                            <v-card-text>
                                <!-- Filter slot for custom filter content -->
                                <slot name="filter"></slot>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="error" variant="text" @click="clearFilters">{{ __('Clear') }}</v-btn>
                                <v-btn color="primary" variant="text" @click="applyFilters">{{ __('Apply') }}</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-menu>

                    <!-- Button Slot -->
                    <slot name="buttons"></slot>

                    <!-- Import Button -->
                    <v-btn v-if="hasImport" :color="importColor"
                        :class="['m-2', 'fw-medium', '!tracking-normal', buttonClass]" :variant="buttonVariant"
                        @click="importItem()" prepend-icon="mdi-database-import">
                        {{ __('Import') }}
                    </v-btn>

                    <!-- Export Button -->
                    <v-btn v-if="hasExport" :color="exportColor"
                        :class="['m-2', 'fw-medium', '!tracking-normal', buttonClass]" :variant="buttonVariant"
                        @click="exportItem()" prepend-icon="mdi-database-export">
                        {{ __('Export') }}
                    </v-btn>

                    <!-- Create Button -->
                    <v-btn v-if="hasCreate" @click="createItem()"
                        :class="['m-2', 'fw-medium', '!tracking-normal', buttonClass]" :color="createColor"
                        :variant="buttonVariant">
                        <v-icon class="me-2">mdi-plus</v-icon>
                        {{ createButtonText }}
                    </v-btn>
                </v-toolbar>

                <!-- Custom Header Slot -->
                <slot name="header"></slot>

                <!-- Progress Indicator for loading -->
                <v-progress-linear v-if="loading" indeterminate color="primary" height="2"></v-progress-linear>
            </template>

            <!-- Numbered Row -->
            <template v-slot:[`item.no`]="{ item }" v-if="showNo">
                <div :class="numberColumnClass">{{ item.no }}</div>
            </template>

            <!-- Default slot for each column customization -->
            <template v-for="(_, name,) in $slots" :key="name" v-slot:[name]="slotData">
                <slot :name="name" v-bind="slotData"></slot>
            </template>

            <!-- Actions Column Customization -->
            <template v-slot:[`item.actions`]="{ item }">
                <div class="actions-wrapper">
                    <v-tooltip v-if="hasView" :text="viewTooltip" location="top">
                        <template v-slot:activator="{ props }">
                            <v-icon v-bind="props" class="me-2" :color="viewColor" :size="iconSize"
                                @click="viewItem(item)" :class="iconClass">
                                {{ viewIcon }}
                            </v-icon>
                        </template>
                    </v-tooltip>

                    <v-tooltip v-if="hasEdit" :text="editTooltip" location="top">
                        <template v-slot:activator="{ props }">
                            <v-icon v-bind="props" class="me-2" :color="editColor" :size="iconSize"
                                @click="editItem(item)" :class="iconClass">
                                {{ editIcon }}
                            </v-icon>
                        </template>
                    </v-tooltip>

                    <v-tooltip v-if="hasDelete" :text="deleteTooltip" location="top">
                        <template v-slot:activator="{ props }">
                            <v-icon v-bind="props" :color="deleteColor" :size="iconSize" @click="deleteItem(item)"
                                :class="iconClass">
                                {{ deleteIcon }}
                            </v-icon>
                        </template>
                    </v-tooltip>

                    <!-- Custom actions slot -->
                    <slot name="item-actions" :item="item"></slot>
                </div>
            </template>

            <!-- Empty State Customization -->
            <template v-slot:no-data>
                <div class="empty-state-wrapper py-5">
                    <v-icon v-if="emptyStateIcon" :size="emptyStateIconSize" :color="emptyStateIconColor" class="mb-4">
                        {{ emptyStateIcon }}
                    </v-icon>
                    <p class="empty-state-text">{{ emptyStateText }}</p>
                    <v-btn v-if="emptyStateAction" :color="createColor" :variant="buttonVariant"
                        @click="emptyStateActionClick">
                        {{ emptyStateActionText }}
                    </v-btn>
                </div>
            </template>

            <!-- Loading state customization -->
            <template v-slot:loading>
                <slot name="loading">
                    <div class="d-flex justify-center align-center py-4">
                        <v-progress-circular indeterminate color="primary"></v-progress-circular>
                    </div>
                </slot>
            </template>

            <!-- Footer customization -->
            <template v-slot:footer>
                <slot name="footer"></slot>
            </template>
        </v-data-table-server>
    </div>
</template>

<script setup>
    import { __ } from 'matice';
    import { computed, ref, useSlots } from 'vue';

    // Add the useSlots composable to access the slots
    const slots = useSlots();

    const props = defineProps({
        hasCreate: {
            type: Boolean,
            required: false,
            default: true,
        },
        hasImport: {
            type: Boolean,
            required: false,
            default: true,
        },
        hasExport: {
            type: Boolean,
            required: false,
            default: true,
        },
        hasView: {
            type: Boolean,
            required: false,
            default: true,
        },
        hasEdit: {
            type: Boolean,
            required: false,
            default: true,
        },
        hasDelete: {
            type: Boolean,
            required: false,
            default: true,
        },
        hasFilter: {
            type: Boolean,
            required: false,
            default: false,
        },
        showNo: {
            type: Boolean,
            required: false,
            default: false,
        },
        showSearch: {
            type: Boolean,
            required: false,
            default: true,
        },
        showSelect: {
            type: Boolean,
            required: false,
            default: false,
        },
        singleSelect: {
            type: Boolean,
            required: false,
            default: false,
        },
        title: {
            type: String,
            required: true,
        },
        serverItems: {
            type: Array,
            required: true,
        },
        itemsLength: {
            type: Number,
            required: true,
        },
        itemsPerPage: {
            type: Number,
            required: false,
            default: 10,
        },
        loading: {
            type: Boolean,
            required: false,
            default: false,
        },
        itemValue: {
            type: String,
            required: false,
            default: 'id',
        },
        headers: {
            type: Array,
            required: true,
        },
        hover: {
            type: Boolean,
            required: false,
            default: true,
        },
        disableSort: {
            type: Boolean,
            required: false,
            default: false,
        },
        buttonVariant: {
            type: String,
            required: false,
            default: 'outlined',
        },
        tableClasses: {
            type: String,
            required: false,
            default: '',
        },
        buttonClass: {
            type: String,
            required: false,
            default: '',
        },
        titleClass: {
            type: String,
            required: false,
            default: '!text-2xl !text-zinc-800',
        },
        toolbarColor: {
            type: String,
            required: false,
            default: '',
        },
        iconSize: {
            type: String,
            required: false,
            default: 'small',
        },
        iconClass: {
            type: String,
            required: false,
            default: '',
        },
        viewIcon: {
            type: String,
            required: false,
            default: 'mdi-eye',
        },
        editIcon: {
            type: String,
            required: false,
            default: 'mdi-pencil',
        },
        deleteIcon: {
            type: String,
            required: false,
            default: 'mdi-delete',
        },
        viewColor: {
            type: String,
            required: false,
            default: 'primary',
        },
        editColor: {
            type: String,
            required: false,
            default: 'secondary',
        },
        deleteColor: {
            type: String,
            required: false,
            default: 'error',
        },
        createColor: {
            type: String,
            required: false,
            default: 'primary',
        },
        importColor: {
            type: String,
            required: false,
            default: 'cyan-darken-4',
        },
        exportColor: {
            type: String,
            required: false,
            default: 'brown-darken-4',
        },
        viewTooltip: {
            type: String,
            required: false,
            default: 'View',
        },
        editTooltip: {
            type: String,
            required: false,
            default: 'Edit',
        },
        deleteTooltip: {
            type: String,
            required: false,
            default: 'Delete',
        },
        numberColumnClass: {
            type: String,
            required: false,
            default: '',
        },
        deleteConfirmText: {
            type: String,
            required: false,
            default: 'Are you sure you want to delete this item?',
        },
        emptyStateText: {
            type: String,
            required: false,
            default: 'No data available',
        },
        emptyStateIcon: {
            type: String,
            required: false,
            default: 'mdi-database-off',
        },
        emptyStateIconSize: {
            type: String,
            required: false,
            default: '64',
        },
        emptyStateIconColor: {
            type: String,
            required: false,
            default: 'grey-lighten-1',
        },
        emptyStateAction: {
            type: Boolean,
            required: false,
            default: false,
        },
        emptyStateActionText: {
            type: String,
            required: false,
            default: 'Create New',
        },
        searchPlaceholder: {
            type: String,
            required: false,
            default: __('Search...'),
        },
        itemClass: {
            type: [String, Function],
            required: false,
            default: '',
        },
        footerProps: {
            type: Object,
            required: false,
            default: () => ({}),
        },
        createButtonText: {
            type: String,
            required: false,
            default: '',
        },
        initialSortBy: {
            type: Array,
            required: false,
            default: () => [],
        },
        serverSideSearch: {
            type: Boolean,
            required: false,
            default: true,
        },
        searchDebounce: {
            type: Number,
            required: false,
            default: 300,
        }
    });

    // State variables
    const itemsPerPage = ref(props.itemsPerPage);
    const page = ref(1);
    const sortBy = ref(props.initialSortBy);
    const searchValue = ref('');
    const filterMenu = ref(false);
    const activeFilters = ref(0);

    let mounted = false;

    const items = computed(() => {
        if (props.showNo) {
            return props.serverItems.map((item, index) => {
                return {
                    no: ((page.value - 1) * itemsPerPage.value) + index + 1,
                    ...item,
                };
            });
        } else {
            return props.serverItems;
        }
    });

    const computedHeaders = computed(() => {
        // Filter headers based on visible columns if column visibility is enabled
        let headers = props.headers;

        if (props.showNo) {
            headers = [
                {
                    title: __('No'),
                    align: 'start',
                    sortable: false,
                    key: 'no',
                    width: '80px',
                },
                ...headers
            ];
        }

        // Add actions column if any of the action options are enabled
        if (props.hasView || props.hasEdit || props.hasDelete || hasSlot('item-actions')) {
            headers.push({
                title: __('Actions'),
                align: 'start',
                sortable: false,
                key: 'actions',
                width: calculateActionColumnWidth(),
            });
        }

        return headers;
    });

    const hasSlot = (name) => {
        return !!slots[name];
    };

    const calculateActionColumnWidth = () => {
        let width = 0;
        if (props.hasView) width += 40;
        if (props.hasEdit) width += 40;
        if (props.hasDelete) width += 40;
        if (hasSlot('item-actions')) width += 40;
        return `${Math.max(width, 100)}px`;
    };

    const itemsPerPageOptions = [10, 20, 30, 40, 50, 100];

    // Emit events
    const emits = defineEmits([
        'view',
        'edit',
        'delete',
        'create',
        'import',
        'export',
        'update:options',
        'filter-apply',
        'filter-clear',
        'empty-action',
    ]);

    // Methods
    const updateOptionsCallback = (options) => {
        page.value = options.page;
        sortBy.value = options.sortBy;

        // Do mot cause emit on first mount
        if (mounted) {
            emits('update:options', options);
        } else {
            mounted = true;
        }
    };

    const viewItem = (item) => {
        emits('view', item);
    };

    const editItem = (item) => {
        emits('edit', item);
    };

    const deleteItem = (item) => {
        emits('delete', item);
    };

    const createItem = () => {
        emits('create');
    };

    const importItem = () => {
        emits('import');
    };

    const exportItem = () => {
        emits('export');
    };

    const applyFilters = () => {
        filterMenu.value = false;
        emits('filter-apply');
    };

    const clearFilters = () => {
        activeFilters.value = 0;
        emits('filter-clear');
    };

    const emptyStateActionClick = () => {
        emits('empty-action');
    };

    // Expose methods and props for parent component
    defineExpose({
        page,
        itemsPerPage,
        sortBy,
        applyFilters,
        clearFilters,
    });
</script>
