<template>
    <data-table-server :showNo="true" :title="__('Languages')" :serverItems="serverItems" :items-length="totalItems"
        :headers="headers" :loading="loading" :server-items="serverItems" :items-per-page="itemsPerPage" item-value="id"
        @update:options="loadItems" :has-create="true" :has-import="true" :has-export="true" @view="viewCallback"
        @delete="deleteCallback" @edit="editCallback" @create="createCallback" @import="importCallback"
        @export="exportCallback" />
</template>

<script setup>
    import { computed, onUpdated, ref, watch } from "vue";
    import { visitModal } from "@inertiaui/modal-vue";
    import { router, usePage } from "@inertiajs/vue3";
    import { route } from "ziggy-js";
    import { __ } from 'matice';
    import { onMounted } from "vue";
    import { toast } from 'vue3-toastify';

    const props = defineProps({
        languages: {
            type: Object,
            required: true,
        },
    });

    const serverItems = computed(() => {
        return props.languages.data;
    });
    const totalItems = computed(() => {
        return props.languages.total;
    });

    const itemsPerPage = computed(() => {
        return props.languages.per_page;
    });

    const loading = ref(false);

    const headers = [
        {
            title: __('Name'),
            align: "start",
            sortable: true,
            key: "name",
        },
        {
            title: __('Created At'),
            align: "start",
            sortable: true,
            key: "created_at",
        },
        {
            title: __('Updated At'),
            align: "start",
            sortable: true,
            key: "updated_at",
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
        visitModal(
            route("dashboard.languages.show", {
                classification: item.id,
            })
        );
    };

    const editCallback = (item) => {
        visitModal(
            route("dashboard.languages.edit", {
                classification: item.id,
            })
        );
    };

    const deleteCallback = (item) => {
        visitModal(
            route("dashboard.languages.delete", {
                classification: item.id,
            })
        );
    };

    const createCallback = () => {
        visitModal(route("dashboard.languages.create"));
    };

    const importCallback = () => {
        visitModal(route("dashboard.languages.import.show"));
    };

    const exportCallback = () => {
        window.location.href = route("dashboard.languages.export");
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
        });
    }

    const page = usePage();

    watch(() => page.props.flash, (flash) => {
        const success = page.props.flash.success;
        const error = page.props.flash.error;

        console.log(page.props);
        console.log(success, error);

        if (success) {
            notify(success);
        } else if (error) {
            notify(error);
        }
    }, {
        deep: true,
    });
</script>
