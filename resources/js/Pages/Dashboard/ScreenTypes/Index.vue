<template>
    <data-table-server :showNo="true" title="ScreenType" :serverItems="serverItems" :items-length="totalItems"
        :headers="headers" :loading="loading" :items-per-page="itemsPerPage" item-value="id" @update:options="loadItems"
        :has-create="true" :has-import="true" :has-export="true" @view="viewCallback" @delete="deleteCallback"
        @edit="editCallback" @create="createCallback" @import="importCallback" @export="exportCallback" />
</template>

<script setup>
    import { computed, ref } from 'vue'
    import { router } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';

    const props = defineProps({
        screenTypes: {
            type: Object,
            required: true,
        }
    });

    const serverItems = computed(() => {
        return props.screenTypes?.data || [];
    });
    const totalItems = computed(() => {
        return props.screenTypes?.total || 0;
    });

    const itemsPerPage = computed(() => {
        return props.screenTypes?.per_page || 10;
    });

    const loading = ref(false);

    const headers = [
        {
            title: 'Name',
            align: 'start',
            sortable: true,
            key: 'name',
        },
        {
            title: 'Description',
            align: 'start',
            sortable: true,
            key: 'description',
        },
        {
            title: 'Created At',
            align: 'start',
            sortable: true,
            key: 'created_at',
        },
        {
            title: 'Updated At',
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

    const viewCallback = (item) => {
        router.get(route('dashboard.screen_types.show', {
            screen_type: item.id,
        }));
    };

    const editCallback = (item) => {
        router.get(route('dashboard.screen_types.edit', {
            screen_type: item.id,
        }));
    };

    const deleteCallback = (item) => {
        router.get(route('dashboard.screen_types.delete', {
            screen_type: item.id,
        }));
    };

    const createCallback = () => {
        router.get(route('dashboard.screen_types.create'));
    };

    const importCallback = () => {
        router.get(route('dashboard.screen_types.import.show'));
    };

    const exportCallback = () => {
        window.location.href = route("dashboard.screen_types.export");
    };
</script>
