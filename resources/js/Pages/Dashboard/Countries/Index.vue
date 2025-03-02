<template>
    <data-table-server :showNo="true" :title="__('Countries')" :serverItems="serverItems" :items-length="totalItems"
        :headers="headers" :loading="loading" :server-items="serverItems" :items-per-page="itemsPerPage" item-value="id"
        @update:options="loadItems" :has-create="true" :has-import="true" :has-export="true" @view="viewCallback"
        @edit="editCallback" @delete="deleteCallback" @create="createCallback" @import="importCallback"
        @export="exportCallback" />
</template>

<script setup>
    import { computed, ref } from 'vue'
    import { router } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';
    import { __ } from 'matice';

    const props = defineProps({
        countries: {
            type: Object,
            required: true,
        }
    });

    const serverItems = computed(() => {
        return props.countries.data;
    });

    const totalItems = computed(() => {
        return props.countries.total;
    });

    const itemsPerPage = computed(() => {
        return props.countries.per_page;
    });

    const loading = ref(false);

    const headers = [
        {
            title: __('Name'),
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
        router.get(route('dashboard.countries.show', {
            country: item.id,
        }));
    };

    const editCallback = (item) => {
        router.get(route('dashboard.countries.edit', {
            country: item.id,
        }));
    };

    const deleteCallback = (item) => {
        router.get(route('dashboard.countries.delete', {
            country: item.id,
        }));
    };

    const createCallback = () => {
        router.get(route('dashboard.countries.create'));
    };

    const importCallback = () => {
        router.get(route('dashboard.countries.import.show'));
    };

    const exportCallback = () => {
        window.location.href = route("dashboard.countries.export");
    };


</script>
