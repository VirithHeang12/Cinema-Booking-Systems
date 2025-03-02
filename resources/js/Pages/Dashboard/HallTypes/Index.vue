<template>
    <data-table-server :showNo="true" :title="__('Hall Types')" :serverItems="serverItems" :items-length="totalItems"
        :headers="headers" :loading="loading" :server-items="serverItems" :items-per-page="itemsPerPage" item-value="id"
        @update:options="loadItems" :has-create="true" :has-import="true" :has-export="true" :sort-by="sortBy"
        @view="viewCallback" @delete="deleteCallback" @edit="editCallback" @create="createCallback"
        @import="importCallback" @export="exportCallback" />
</template>

<script setup>
    import { computed, ref } from 'vue'
    import { router } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';
    import { __ } from 'matice';

    const props = defineProps({
        hall_types: {
            type: Object,
            required: true,
        }
    });

    const serverItems = computed(() => {
        return props.hall_types.data;
    });
    const totalItems = computed(() => {
        return props.hall_types.total;
    });

    const itemsPerPage = computed(() => {
        return props.hall_types.per_page;
    });

    const loading = ref(false);

    const headers = [
        {
            title: __('Name'),
            align: 'start',
            sortable: true,
            key: 'name',
        },
        {
            title: __('Created At'),
            align: 'start',
            sortable: true,
            key: 'created_at',
        },
        {
            title: __('Updated At'),
            align: 'start',
            sortable: true,
            key: 'updated_at',
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
    function loadItems({ page, itemsPerPage }) {
        router.reload({
            data: {
                page,
                itemsPerPage,
            },
        });
    }

    const sortBy = ref([
        {
            key: 'name',
            direction: 'asc',
        },
        {
            key: 'created_at',
            direction: 'asc',
        },
        {
            key: 'updated_at',
            direction: 'asc',
        }
    ]);

    const viewCallback = (item) => {
        router.get(route('dashboard.hall_types.show', {
            hall_type: item.id,
        }));
    };

    const editCallback = (item) => {
        router.get(route('dashboard.hall_types.edit', {
            hall_type: item.id,
        }));
    };

    const deleteCallback = (item) => {
        router.get(route('dashboard.hall_types.delete', {
            hall_type: item.id,
        }));
    };

    const createCallback = () => {
        router.get(route('dashboard.hall_types.create'));
    };

    const importCallback = () => {
        router.get(route('dashboard.hall_types.import.show'));
    };

    const exportCallback = () => {
        window.location.href = route("dashboard.hall_types.export");
    };
</script>
