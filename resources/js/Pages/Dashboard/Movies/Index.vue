<template>
    <data-table-server :showNo="true" title="Movie" :serverItems="serverItems" :items-length="totalItems"
        :headers="headers" :loading="loading" :server-items="serverItems" :items-per-page="itemsPerPage" item-value="id"
        @update:options="loadItems" :has-create="true" :has-import="true" :has-export="true" @view="viewCallback"
        @edit="editCallback" @delete="deleteCallback" @create="createCallback" @import="importCallback"
        @export="exportCallback" />
</template>

<script setup>
    import { computed, ref } from 'vue'
    import { route } from 'ziggy-js';
    import { router } from '@inertiajs/vue3';
    import { visitModal } from '@inertiaui/modal-vue';

    const props = defineProps({
        movies: {
            type: Object,
            required: true,
        }
    });

    const serverItems = computed(() => {
        return props.movies.data;
    });

    const totalItems = computed(() => {
        return props.movies.total;
    });

    const itemsPerPage = computed(() => {
        return props.movies.per_page;
    });

    const loading = ref(false);

    const headers = [
        {
            title: 'Name',
            align: 'start',
            sortable: true,
            key: 'name',
        }
    ];


    function loadItems({ page, itemsPerPage }) {
        router.reload({
            data: {
                page,
                itemsPerPage
            },
        });
    }

    const viewCallback = (item) => {
        // router.get(route('dashboard.movies.show', {
        //     movie: item.id,
        // }));
    };

    const editCallback = (item) => {
        // router.get(route('dashboard.movies.edit', {
        //     movie: item.id,
        // }));
    };

    const deleteCallback = (item) => {
        // router.get(route('dashboard.movies.delete', {
        //     movie: item.id,
        // }));

    };

    /**
     * Create callback
     *
     * @returns {void}
     */
    const createCallback = () => {
        visitModal(route('dashboard.movies.create'));
    };

    const importCallback = () => {
        router.get(route('dashboard.movies.import.show'));
    };

    const exportCallback = () => {
        window.location.href = route("dashboard.movies.export");
    };


</script>
