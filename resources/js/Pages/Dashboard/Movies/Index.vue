<template>
    <data-table-server :showNo="true" title="Movie" :serverItems="serverItems" :items-length="totalItems"
        :headers="headers" :loading="loading" :server-items="serverItems" :items-per-page="itemsPerPage" item-value="id"
        @update:options="loadItems" :has-create="true" :has-import="true" :has-export="true" @view="viewCallback"
        @edit="editCallback" @delete="deleteCallback" @create="createCallback" @import="importCallback"
        @export="exportCallback" />
</template>

<script setup>
    import { computed, ref } from 'vue'
    import { visitModal } from '@inertiaui/modal-vue';
    import { router } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';

    const props = defineProps({
        movies: {
            type: Object,
            required: true,
        }
    });

    console.log(props.movies);

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
        visitModal(route('dashboard.movies.show', {
            movie: item.id,
        }), {
            method: 'get',
            config: {
                slideover: false,
                position: 'center',
                closeExplicitly: true,
                maxWidth: 'xl',
            },
        });
    };

    const editCallback = (item) => {
        visitModal(route('dashboard.movies.edit', {
            movie: item.id,
        }), {
            method: 'get',
            config: {
                slideover: true,
                position: 'right',
                closeExplicitly: true,
                maxWidth: '2xl',
            },
        });
    };

    const deleteCallback = (item) => {
        visitModal(route('dashboard.movies.delete', {
            movie: item.id,
        }), {
            config: {
                slideover: false,
                position: 'center',
                closeExplicitly: true,
                maxWidth: 'xl',

            },

        });

    };

    const createCallback = () => {
        // visitModal(route('dashboard.movies.create'), {
        //     config: {
        //         slideover: true,
        //         position: 'right',
        //         closeExplicitly: true,
        //         maxWidth: '2xl',
        //     },

        // });
        router.get(route('dashboard.movies.create'));
    };

    const importCallback = () => {
        visitModal(route("dashboard.movies.import.show"), {
            config: {
                slideover: false,
                position: "center",
                closeExplicitly: true,
                maxWidth: "xl",
            },
        });
    };

    const exportCallback = () => {
        window.location.href = route("dashboard.movies.export");
    };


</script>
