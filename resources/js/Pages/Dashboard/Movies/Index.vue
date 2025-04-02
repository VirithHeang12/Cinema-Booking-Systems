<template>
    <data-table-server :showNo="true" title="Movie" :serverItems="serverItems" :items-length="totalItems"
        :headers="headers" :loading="loading" :server-items="serverItems" :items-per-page="itemsPerPage" item-value="id"
        @update:options="loadItems" :has-create="true" :has-import="true" :has-export="true" @view="viewCallback"
        @edit="editCallback" @delete="deleteCallback" @create="createCallback" @import="importCallback"
        @export="exportCallback" />
</template>

<script setup>
    import { computed, ref, watch } from 'vue'
    import { route } from 'ziggy-js';
    import { router, usePage } from '@inertiajs/vue3';
    import { visitModal } from '@inertiaui/modal-vue';
    import { toast } from 'vue3-toastify';

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
        return props.movies.meta.total;
    });

    const itemsPerPage = computed(() => {
        return props.movies.per_page;
    });

    const loading = ref(false);

    const headers = [
        {
            title: 'Title',
            align: 'start',
            sortable: true,
            key: 'title',
        },
        {
            title: 'Duration',
            align: 'start',
            sortable: true,
            key: 'duration',
        },
        {
            title: 'Release Date',
            align: 'start',
            sortable: true,
            key: 'release_date',
        },
        {
            title: 'Country',
            align: 'start',
            sortable: true,
            key: 'country',
        },
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
        visitModal(route('dashboard.movies.edit', {
            movie: item.id,
        }));
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

    /**
     * Notify the user
     *
     * @param {string} message
     *
     * @return void
     */
    const notify = (message) => {
        toast(message, {
            autoClose: 1500,
            position: toast.POSITION.BOTTOM_RIGHT,
            type: 'success',
            hideProgressBar: true,
        });
    }

    const page = usePage();

    /**
     * Watch for flash messages
     *
     * @return void
     */
    watch(() => page.props.flash, (flash) => {
        const success = page.props.flash.success;
        const error = page.props.flash.error;

        if (success) {
            notify(success);
        } else if (error) {
            notify(error);
        }
    }, {
        deep: true,
    });


</script>
