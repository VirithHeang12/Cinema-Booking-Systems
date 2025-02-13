<template>
    <v-data-table-server density="comfortable" :disable-sort="true" @update:options="updateOptionsCallback"
        :items="items" :items-length="itemsLength" v-model:items-per-page="itemsPerPage" :headers="computedHeaders"
        :loading="loading" :items-per-page-options="itemsPerPageOptions">
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>{{ title }}</v-toolbar-title>
                <v-spacer></v-spacer>

                <v-btn v-if="hasImport" type="button" color="cyan-darken-4" class="m-2" variant="outlined"
                    @click="importItem()">
                    Import
                </v-btn>

                <v-btn v-if="hasExport" type="button" color="brown-darken-4" class="m-2" variant="outlined"
                    @click="exportItem()">
                    Export
                </v-btn>

                <v-btn v-if="hasCreate" @click="createItem()" class="m-2" prepend-icon="mdi-plus" color="primary"
                    variant="outlined">
                    New {{ title }}
                </v-btn>

            </v-toolbar>
        </template>

        <template v-slot:[`item.no`]="{ item }" v-if="showNo">
            {{ item.no }}
        </template>

        <template v-slot:[`item.actions`]="{ item }">
            <v-icon class="me-3" color="primary" size="small" @click="viewItem(item)">
                mdi-eye
            </v-icon>
            <v-icon class="me-3" color="secondary" size="small" @click="editItem(item)">
                mdi-pencil
            </v-icon>
            <v-icon class="me-3" color="danger" size="small" @click="deleteItem(item)">
                mdi-delete
            </v-icon>
        </template>
        <template v-slot:no-data>
            <p>There is no data to display</p>
        </template>
    </v-data-table-server>
</template>

<script setup>
    import { computed, ref } from 'vue';

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
        showNo: {
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
    });

    const itemsPerPage = ref(props.itemsPerPage);
    const page = ref(0);

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
        if (props.showNo) {
            return [
                {
                    title: 'No',
                    align: 'start',
                    sortable: false,
                    value: 'no',
                },
                ...props.headers,
                {
                    title: 'Actions',
                    align: 'start',
                    sortable: false,
                    value: 'actions',
                },
            ];
        } else {
            return [
                ...props.headers,
                {
                    title: 'Actions',
                    align: 'start',
                    sortable: false,
                    value: 'actions',
                },
            ];
        }
    });

    const itemsPerPageOptions = [5, 10, 20, 30, 40, 50];

    const emits = defineEmits(['view', 'edit', 'delete', 'create', 'import', 'export', '@update:options']);

    const updateOptionsCallback = (options) => {
        page.value = options.page;
        emits('@update:options', options);
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
</script>
