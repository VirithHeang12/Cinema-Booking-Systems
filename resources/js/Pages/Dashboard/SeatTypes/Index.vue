<template>
    <div class="seat-type-list-container">
        <!-- Main table component -->
        <data-table-server :showNo="true" :title="__('Seat Types')" :createButtonText="__('New SeatType')"
            :serverItems="serverItems" :items-length="totalItems" :headers="headers" :loading="loading"
            :itemsPerPage="itemsPerPage" item-value="id" @update:options="loadItems" @view="viewCallback"
            @edit="editCallback" @delete="deleteCallback" @create="createCallback" @import="importCallback"
            @export="exportCallback" :emptyStateText="__('No seat types found in the database')"
            :emptyStateAction="true" :emptyStateActionText="__('Add First Seat Type')" @empty-action="createCallback"
            buttonVariant="outlined" :viewTooltip="__('View Seat Type Details')"
            :editTooltip="__('Edit Seat Type Information')" :deleteTooltip="__('Delete this Seat Type')"
            titleClass="text-2xl font-bold text-primary mb-4" :hasFilter="false"
            tableClasses="seat-type-data-table elevation-2 rounded-lg" iconSize="small"
            :deleteConfirmText="__('Are you sure you want to delete this seat type? This action cannot be undone.')"
            toolbarColor="white" :showSelect="false">
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
        seat_types: {
            type: Object,
            required: true,
        }
    });

    // State variables
    const loading = ref(false);
    const page = ref(1);
    const sortBy = ref([]);

    // Computed properties
    const serverItems = computed(() => {
        return props.seat_types.data;
    });

    const totalItems = computed(() => {
        return props.seat_types.meta.total;
    });

    const itemsPerPage = computed(() => {
        return props.seat_types.per_page;
    });

    // Table headers definition
    const headers = [
        {
            title: __('Name'),
            align: 'start',
            sortable: true,
            key: 'name',
        },
        {
            title: __('Description'),
            align: 'start',
            sortable: false,
            key: 'description',
            width: '200px',
        },
        {
            title: __('Price'),
            align: 'center',
            sortable: true,
            key: 'price',
        },
        {
            title: __('Seat'),
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
            },
            preserveState: true,
            only: ['seat_types'],
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
     * Open the create seat type slideover
     *
     * @return void
     */
    const createCallback = () => {
        visitModal(route('dashboard.seat_types.create'));
    };

    /**
     * Open the view seat type slideover
     *
     * @param item
     *
     * @return void
     */
    const viewCallback = (item) => {
        visitModal(route('dashboard.seat_types.show', {
            seat_type: item.id,
        }), {
            config: {
                slideover: false
            }
        });
    };

    /**
     * Open the edit seat type slideover
     *
     * @param item
     *
     * @return void
     */
    const editCallback = (item) => {
        visitModal(route('dashboard.seat_types.edit', {
            seat_type: item.id,
        }));
    };

    /**
     * Show the delete confirmation modal
     *
     * @param item
     *
     * @return void
     */
    const deleteCallback = (item) => {
        visitModal(route('dashboard.seat_types.delete', {
            seat_type: item.id,
        }), {
            config: {
                slideover: false,
                closeExplicitly: true,
            }
        });
    };

    /**
     * Open the import seat type slideover
     *
     * @return void
     */
    const importCallback = () => {
        visitModal(route('dashboard.seat_types.import.show'), {
            config: {
                slideover: false,
                closeExplicitly: true,
            }
        });
    };

    /**
     * Export seat types
     *
     * @return void
     */
    const exportCallback = () => {
        window.location.href = route("dashboard.seat_types.export");
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
    .seat-type-list-container {
        border-radius: 12px;
        border-radius: 20px;
    }

    .filter-section {
        min-width: 300px;
        padding: 16px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    .seat-type-data-table :deep(.v-data-table__td) {
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
