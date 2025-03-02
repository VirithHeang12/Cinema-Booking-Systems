<template>
    <data-table-server :showNo="true" :title="__('Classifications')" :serverItems="serverItems"
        :items-length="totalItems" :headers="headers" :loading="loading" :server-items="serverItems"
        :items-per-page="itemsPerPage" item-value="id" @update:options="loadItems" :has-create="true" :has-import="true"
        :has-export="true" @view="viewCallback" @delete="deleteCallback" @edit="editCallback" @create="createCallback"
        @import="importCallback" @export="exportCallback" />
</template>

<script setup>
    import { computed, ref } from "vue";
    import { router } from "@inertiajs/vue3";
    import { route } from "ziggy-js";
    import { __ } from 'matice';

    const props = defineProps({
        classifications: {
            type: Object,
            required: true,
        },
    });

    const serverItems = computed(() => {
        return props.classifications.data;
    });
    const totalItems = computed(() => {
        return props.classifications.total;
    });

    const itemsPerPage = computed(() => {
        return props.classifications.per_page;
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
        router.get(route("dashboard.classifications.show", { classification: item.id }));
    };

    const editCallback = (item) => {
        router.get(route("dashboard.classifications.edit", { classification: item.id }));
    };

    const deleteCallback = (item) => {
        router.get(route("dashboard.classifications.delete", { classification: item.id }));
    };

    const createCallback = () => {
        router.get(route("dashboard.classifications.create"));
    };

    const importCallback = () => {
        router.get(route("dashboard.classifications.import.show"));
    };

    const exportCallback = () => {
        window.location.href = route("dashboard.classifications.export");
    };
</script>
