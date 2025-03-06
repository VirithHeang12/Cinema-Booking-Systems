<template>
    <data-table-server :showNo="true" title="Hall" :serverItems="serverItems" :items-length="totalItems"
        :headers="headers" :loading="loading" :server-items="serverItems" :items-per-page="itemsPerPage" item-value="id"
        @update:options="loadItems" :has-create="true" :has-import="true" :has-export="true" @view="viewCallback"
        @edit="editCallback" @delete="deleteCallback" @create="createCallback" @import="importCallback"
        @export="exportCallback" />
</template>

<script setup>
    import { computed, ref } from 'vue'
    import { router } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';

    const props = defineProps({
        halls: {
            type: Object,
            required: true,
        }
    });

    const serverItems = computed(() => {
        return props.halls.data;
    });

    const totalItems = computed(() => {
        return props.halls.total;
    });

    const itemsPerPage = computed(() => {
        return props.halls.per_page;
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
        router.get(route('dashboard.halls.show', {
            movie: item.id,
        }));
    };

    const editCallback = (item) => {
        router.get(route('dashboard.halls.edit', {
            movie: item.id,
        }));
    };

    const deleteCallback = (item) => {
        router.get(route('dashboard.halls.delete', {
            movie: item.id,
        }));
    };

    const createCallback = () => {
        router.get(route('dashboard.halls.create'));
    };

    const importCallback = () => {
        router.get(route('dashboard.halls.import.show'));
    };

    const exportCallback = () => {
        window.location.href = route("dashboard.halls.export");
    };


</script>
