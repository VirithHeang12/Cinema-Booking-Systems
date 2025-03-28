<template>
    <data-table-server :showNo="true" :title="__('Genres')" :serverItems="serverItems" :items-length="totalItems"
        :headers="headers" :loading="loading" :server-items="serverItems" :items-per-page="itemsPerPage" item-value="id"
        @update:options="loadItems" :has-create="true" :has-import="true" :has-export="true" @view="viewCallback"
        @delete="deleteCallback" @edit="editCallback" @create="createCallback" @import="importCallback"
        @export="exportCallback" />
</template>

<script setup>
    import { computed, ref , watch } from "vue";
    import { visitModal } from "@inertiaui/modal-vue";
    import { router , usePage } from "@inertiajs/vue3";
    import { route } from "ziggy-js";
    import { __ } from 'matice';
    import { toast } from 'vue3-toastify';

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
        visitModal(route('dashboard.genres.show', {
            genre: item.id,
        }), {
            method: 'get',
            config: {
                slideover: false,
                position: 'center',
                closeExplicitly: true,
                maxWidth: '2xl',
            },
        });

    };

    const editCallback = (item) => {
        visitModal(route('dashboard.genres.edit', {
            genre: item.id,
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
        visitModal(route('dashboard.genres.delete', {
            genre: item.id,
        }), {
            config: {
                slideover: false,
                position: 'center',
                closeExplicitly: true,
                maxWidth: '2xl',
            },

        });

    };

    const createCallback = () => {
        visitModal(route('dashboard.genres.create'), {
            config: {
                slideover: true,
                position: 'right',
                closeExplicitly: true,
                maxWidth: '2xl',
            },

        });
    };

    const importCallback = () => {
        visitModal(route("dashboard.genres.import.show"), {
            config: {
                slideover: false,
                position: "center",
                closeExplicitly: true,
                maxWidth: "xl",
            },
        });
    };

    const exportCallback = () => {
        window.location.href = route("dashboard.genres.export");
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
