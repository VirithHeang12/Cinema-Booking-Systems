<template>
    <div class="hall-list-container">
        <!-- Main table component -->
        <data-table-server :showNo="true" title="Halls" createButtonText="New Hall" :serverItems="serverItems"
            :items-length="totalItems" :headers="headers" :loading="loading" :itemsPerPage="itemsPerPage"
            item-value="id" @update:options="loadItems" @view="viewCallback" @edit="editCallback"
            @delete="deleteCallback" @create="createCallback" @import="importCallback" @export="exportCallback"
            emptyStateText="No halls found in the database" :emptyStateAction="true"
            emptyStateActionText="Add First Hall" @empty-action="createCallback" buttonVariant="outlined"
            viewTooltip="View Hall Details" editTooltip="Edit Hall Information" deleteTooltip="Delete this Hall"
            titleClass="text-2xl font-bold text-primary mb-4" :hasFilter="true" @filter-apply="applyFilters"
            @filter-clear="clearFilters" tableClasses="hall-data-table elevation-2 rounded-lg" iconSize="small"
            deleteConfirmText="Are you sure you want to delete this hall? This action cannot be undone."
            toolbarColor="white" :showSelect="false">

            <!-- Filter Content -->
            <template #filter>
                <div class="filter-section">
                    <v-select v-model="filterHallType" :items="hallTypeOptions" label="Hall Type" clearable
                        variant="outlined" density="compact" class="mb-3" hide-details></v-select>
                </div>
            </template>
        </data-table-server>
    </div>
</template>

<script setup>
    import { ref, computed, watch } from 'vue';
    import { __ } from 'matice';
    import { route } from 'ziggy-js';
    import { router, usePage } from '@inertiajs/vue3';
    import { toast } from 'vue3-toastify';
    import { visitModal } from "@inertiaui/modal-vue";

    const props = defineProps({
        halls: {
            type: Object,
            required: true,
        }
    });

    // State variables
    const loading = ref(false);
    const page = ref(1);
    const sortBy = ref([]);

    // Filter states
    const filterHallType = ref(null);

    // Computed properties
    const serverItems = computed(() => {
        return props.halls.data;
    });

    const totalItems = computed(() => {
        return props.halls.meta.total;
    });

    const itemsPerPage = computed(() => {
        return props.halls.per_page;
    });

    // Compute countries to only show unique values
    const hallTypeOptions = computed(() => {
        const hallTypes = [...new Set(props.halls.data.map(hall => hall.hall_type))];
        return hallTypes.map(hallType => ({ title: hallType, value: hallType }));
    });

    // Table headers definition
    const headers = [
        {
            title: 'Name',
            align: 'start',
            sortable: true,
            key: 'name',
        },
        {
            title: 'Description',
            align: 'center',
            sortable: false,
            key: 'description',
            width: '200px',
        },
        {
            title: 'Hall Type',
            align: 'center',
            sortable: false,
            key: 'hall_type',
        },
        {
            title: 'Seats',
            align: 'center',
            sortable: true,
            key: 'seats_count',
        },
    ];

    /**
     * Load items from the server
     *
     * @param options
     *
     * @return void
     */
    function loadItems(options) {
        loading.value = true;
        page.value = options.page;
        sortBy.value = options.sortBy;

        let sortKeyWithDirection = options.sortBy.length > 0 ? options.sortBy[0].key : null;

        if (sortKeyWithDirection) {
            sortKeyWithDirection = options.sortBy[0].order === 'asc' ? sortKeyWithDirection : '-' + sortKeyWithDirection;
        }

        router.reload({
            data: {
                page: options.page,
                itemsPerPage: options.itemsPerPage,
                sort: sortKeyWithDirection,
                'filter[search]': options.search,
                'filter[hall_type]': filterHallType.value,
            },
            preserveState: true,
            only: ['halls'],
            onSuccess: () => {
                loading.value = false;
            },
            onError: () => {
                loading.value = false;
                notify('Failed to load data', 'error');
            }
        });
    }

    /**
     * Apply filters to the table
     *
     * @return void
     */
    function applyFilters() {
        loadItems({
            page: 1,
            itemsPerPage: itemsPerPage.value,
            sortBy: sortBy.value,
        });
    }

    /**
     * Clear all filters
     *
     * @return void
     */
    function clearFilters() {
        filterHallType.value = null;

        loadItems({
            page: 1,
            itemsPerPage: itemsPerPage.value,
            sortBy: sortBy.value,
        });
    }

    /**
     * Open the create hall slideover
     *
     * @return void
     */
    const createCallback = () => {
        visitModal(route('dashboard.halls.create'));
    };

    /**
     * Open the view hall slideover
     *
     * @param item
     *
     * @return void
     */
    const viewCallback = (item) => {
        visitModal(route('dashboard.halls.show', {
            hall: item.id,
        }));
    };

    /**
     * Open the edit hall slideover
     *
     * @param item
     *
     * @return void
     */
    const editCallback = (item) => {
        visitModal(route('dashboard.halls.edit', {
            hall: item.id,
        }));
    };

    /**
     * Show the delete confirmation dialog
     *
     * @param item
     *
     * @return void
     */
    const deleteCallback = (item) => {
        visitModal(route('dashboard.halls.delete', {
            hall: item.id,
        }), {
            config: {
                slideover: false
            }
        });
    };

    /**
     * Open the import hall slideover
     *
     * @return void
     */
    const importCallback = () => {
        visitModal(route('dashboard.halls.import.show'), {
            config: {
                slideover: false,
                closeExplicitly: true,
            }
        });
    };

    /**
     * Export halls
     *
     * @return void
     */
    const exportCallback = () => {
        window.location.href = route("dashboard.halls.export");
    };

    /**
     * Notify the user
     *
     * @param {string} message
     * @param {string} type
     *
     * @return void
     */
    const notify = (message, type = 'success') => {
        toast(message, {
            autoClose: 1500,
            position: toast.POSITION.BOTTOM_RIGHT,
            type: type,
            hideProgressBar: true,
        });
    }

    const p = usePage();

    /**
     * Watch for flash messages
     *
     * @return void
     */
    watch(() => p.props.flash, (flash) => {
        const success = p.props.flash.success;
        const error = p.props.flash.error;

        if (success) {
            notify(success);
        } else if (error) {
            notify(error, 'error');
        }
    }, {
        deep: true,
    });
</script>

<style scoped>
    .hall-list-container {
        border-radius: 12px;
        border-radius: 20px;
    }

    .filter-section {
        min-width: 300px;
        padding: 16px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    .hall-data-table :deep(.v-data-table__td) {
        padding-top: 14px !important;
        padding-bottom: 14px !important;
        font-size: 14px !important;
    }

    /* Custom styling for the data table */
    :deep(.v-data-table-server .v-data-table) {
        box-shadow: none;
        border-radius: 8px;
        overflow: hidden;
    }

    :deep(.v-data-table__tbody tr:hover) {
        background-color: rgba(66, 133, 244, 0.05);
    }

    :deep(.v-data-table__thead th) {
        background-color: #f5f5f5;
        font-weight: 600 !important;
        color: #333 !important;
        text-transform: none !important;
        letter-spacing: 0 !important;
    }

    :deep(.v-data-table__thead tr th:first-child) {
        border-top-left-radius: 8px;
    }

    :deep(.v-data-table__thead tr th:last-child) {
        border-top-right-radius: 8px;
    }

    :deep(.v-btn) {
        text-transform: none;
        letter-spacing: 0;
    }
</style>
