<template>
    <data-table-server :showNo="true" title="HallType" :serverItems="serverItems" :items-length="totalItems"
        :headers="headers" :loading="loading" :server-items="serverItems" :items-per-page="itemsPerPage" item-value="id"
        @update:options="loadItems" :has-create="true" :has-import="true" :has-export="true" :sort-by="sortBy" 
        @view="viewCallback"
        @delete="deleteCallback" 
        @edit="editCallback" 
        @create="createCallback"
        @import="importCallback"
        @export="exportCallback"/>
</template>

<script setup>
    import { computed, ref } from 'vue'
    import { visitModal } from '@inertiaui/modal-vue';
    import { router } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';

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

    const sortBy = ref([
        {
            key: 'name',
            direction: 'asc',
        },
        {
            key: 'description',
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
        visitModal(route('dashboard.hall_types.show', {
            hall_type: item.id,
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
        visitModal(route('dashboard.hall_types.edit', {
            hall_type: item.id,
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
        visitModal(route('dashboard.hall_types.delete', {
            hall_type: item.id,
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
        visitModal(route('dashboard.hall_types.create'), {
            config: {
                slideover: true,
                position: 'right',
                closeExplicitly: true,
                maxWidth: '2xl',
            },

        });

    };
    
    const importCallback = () => {
        visitModal(route("dashboard.hall_types.import.show"), {
        config: {
            slideover: false,
            position: "center",
            closeExplicitly: true,
            maxWidth: "xl",
        },
        });
    };

    const exportCallback = () => {
        window.location.href = route("dashboard.hall_types.export");
    };
</script>
