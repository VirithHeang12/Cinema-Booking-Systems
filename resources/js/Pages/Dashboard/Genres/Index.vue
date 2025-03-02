<template>
    <data-table-server :showNo="true" :title="__('Genres')" :serverItems="serverItems" :items-length="totalItems"
        :headers="headers" :loading="loading" :server-items="serverItems" :items-per-page="itemsPerPage" item-value="id"
        @update:options="loadItems" :has-create="true" :has-import="true" :has-export="true" @view="viewCallback"
        @delete="deleteCallback" @edit="editCallback" @create="createCallback" @import="importCallback"
        @export="exportCallback" />
</template>

<script setup>
    import { computed, ref } from "vue";
    import { router } from "@inertiajs/vue3";
    import { route } from "ziggy-js";
    import { __ } from 'matice';

    const props = defineProps({
        genres: {
            type: Object,
            required: true,
        }
    });

    const serverItems = computed(() => {
        return props.genres.data;
    });
    const totalItems = computed(() => {
        return props.genres.total;
    });

    const itemsPerPage = computed(() => {
        return props.genres.per_page;
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
            title: __('Description'),
            align: 'start',
            sortable: true,
            key: 'description',
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

    const viewCallback = (item) => {
        router.get(route('dashboard.genres.show', {
            genre: item.id,
        }));
    };

    const editCallback = (item) => {
        router.get(route('dashboard.genres.edit', {
            genre: item.id,
        }));
    };

    const deleteCallback = (item) => {
        router.get(route('dashboard.genres.delete', {
            genre: item.id,
        }));
    };

    const createCallback = () => {
        router.get(route('dashboard.genres.create'));
    };

    const importCallback = () => {
        router.get(route('dashboard.genres.import.show'));
    };

    const exportCallback = () => {
        window.location.href = route("dashboard.genres.export");
    };
</script>
