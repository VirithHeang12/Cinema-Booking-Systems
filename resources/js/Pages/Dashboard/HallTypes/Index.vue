<template>
    <data-table-server :showNo="true" :title="__('Hall Types')" createButtonText="New Halltype" :serverItems="serverItems"
        :items-length="totalItems" :headers="headers" :loading="loading" :itemsPerPage="itemsPerPage"
        item-value="id" @update:options="loadItems" @view="viewCallback" @edit="editCallback"
        @delete="deleteCallback" @create="createCallback" @import="importCallback" @export="exportCallback"
        emptyStateText="No halltype found in the database" :emptyStateAction="true"
        emptyStateActionText="Add First Halltype" @empty-action="createCallback" buttonVariant="outlined"
        viewTooltip="View Halltype Details" editTooltip="Edit Halltype Information" deleteTooltip="Delete this Halltype"
        titleClass="text-2xl font-bold text-primary mb-4" tableClasses="halltype-data-table elevation-2 rounded-lg" iconSize="small"
        deleteConfirmText="Are you sure you want to delete this halltype? This action cannot be undone."
        toolbarColor="white" :showSelect="false">
    </data-table-server>  
</template>

<script setup>
    import { computed, ref, watch } from 'vue'
    import { visitModal } from '@inertiaui/modal-vue';
    import { router, usePage } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';
    import { __ } from 'matice';
    import { toast } from 'vue3-toastify';

    const props = defineProps({
        hall_types: {
            type: Object,
            required: true,
        }
    });

    // State variables
    const loading = ref(false);
    const lastUpdated = ref(new Date().toLocaleString());
    const page = ref(1);
    const sortBy = ref([]);

    const serverItems = computed(() => {
        return props.hall_types.data;
    });
    const totalItems = computed(() => {
        return props.hall_types.meta.total;
    });

    const itemsPerPage = computed(() => {
        return props.hall_types.per_page;
    });

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
        },
    ];


    /**
     * Load items from the server
     *
     * @param {Object} options
     * @param {Number} options.page
     * @param {Number} options.itemsPerPage
     * @param {Array} options.sortBy
     *
     * @return {void}
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
            only: ['hall_types'],
            onSuccess: () => {
                loading.value = false;
                lastUpdated.value = new Date().toLocaleString();
            },
            onError: () => {
                loading.value = false;
                notify('Failed to load data', 'error');
            }
        });
    }

    const viewCallback = (item) => {
        visitModal(route('dashboard.hall_types.show', {
            hall_type: item.id,
        }));
    };

    const editCallback = (item) => {
        visitModal(route('dashboard.hall_types.edit', {
            hall_type: item.id,
        }));
    };

    const deleteCallback = (item) => {
        visitModal(route('dashboard.hall_types.delete', {
            hall_type: item.id,
        }), {
            config: {
                slideover: false,
            },

        });
    };

    const createCallback = () => {
        visitModal(route('dashboard.hall_types.create'))
    };

    const importCallback = () => {
        visitModal(route("dashboard.hall_types.import.show"), {
            config: {
                slideover: false,
                closeExplicitly: true,
            },
        });
    };

    const exportCallback = () => {
        window.location.href = route("dashboard.hall_types.export");
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
    .halltype-data-table :deep(.v-data-table__td) {
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
