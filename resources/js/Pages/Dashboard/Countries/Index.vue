<template>
    <div class="country-list-container">
        <!-- Main table component -->
        <data-table-server :showNo="true" :title="__('Countries')" :createButtonText="__('New Country')"
            :serverItems="serverItems" :items-length="totalItems" :headers="headers" :loading="loading"
            :itemsPerPage="itemsPerPage" item-value="id" @update:options="loadItems" @view="viewCallback"
            @edit="editCallback" @delete="deleteCallback" @create="createCallback" @import="importCallback"
            @export="exportCallback" :emptyStateText="__('No countries found in the database')" :emptyStateAction="true"
            :emptyStateActionText="__('Add First Country')" @empty-action="createCallback" buttonVariant="outlined"
            :viewTooltip="__('View Country Details')" :editTooltip="__('Edit Country Information')"
            :deleteTooltip="__('Delete this Country')" titleClass="text-2xl font-bold text-primary mb-4"
            :hasFilter="false" tableClasses="country-data-table elevation-2 rounded-lg" iconSize="small"
            :deleteConfirmText="__('Are you sure you want to delete this country? This action cannot be undone.')"
            toolbarColor="white" :showSelect="false">
        </data-table-server>
    </div>
</template>

<script setup>
    import { ref, computed } from 'vue';
    import { __ } from 'matice';
    import { route } from 'ziggy-js';
    import { router } from '@inertiajs/vue3';
    import { visitModal } from "@inertiaui/modal-vue";

    const props = defineProps({
        countries: {
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
        return props.countries.data;
    });

    const totalItems = computed(() => {
        return props.countries.meta.total;
    });

    const itemsPerPage = computed(() => {
        return props.countries.per_page;
    });


    // Table headers definition
    const headers = [
        {
            title: __('Name'),
            align: 'start',
            sortable: true,
            key: 'name',
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
            only: ['countries'],
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
     * Open the create country slideover
     *
     * @return void
     */
    const createCallback = () => {
        visitModal(route('dashboard.countries.create'));
    };

    /**
     * Open the view country slideover
     *
     * @param item
     *
     * @return void
     */
    const viewCallback = (item) => {
        visitModal(route('dashboard.countries.show', {
            country: item.id,
        }), {
            config: {
                slideover: false,
                closeExplicitly: true,
            }
        });
    };

    /**
     * Open the edit country slideover
     *
     * @param item
     *
     * @return void
     */
    const editCallback = (item) => {
        visitModal(route('dashboard.countries.edit', {
            country: item.id,
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
        visitModal(route('dashboard.countries.delete', {
            country: item.id,
        }), {
            config: {
                slideover: false,
                closeExplicitly: true,
            }
        });
    };

    /**
     * Open the import countries slideover
     *
     * @return void
     */
    const importCallback = () => {
        visitModal(route('dashboard.countries.import.show'), {
            config: {
                slideover: false,
                closeExplicitly: true,
            }
        });
    };

    /**
     * Export countries
     *
     * @return void
     */
    const exportCallback = () => {
        window.location.href = route("dashboard.countries.export");
    };
</script>

<style scoped>
    .countries-list-container {
        border-radius: 12px;
        border-radius: 20px;
    }

    .filter-section {
        min-width: 300px;
        padding: 16px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    .countries-data-table :deep(.v-data-table__td) {
        padding-top: 14px !important;
        padding-bottom: 14px !important;
        font-size: 14px !important;
    }
</style>
