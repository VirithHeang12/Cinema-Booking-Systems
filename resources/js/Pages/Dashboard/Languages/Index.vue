<template>
    <data-table :itemsPerPage="itemsPerPage" title="Language" :items="items" :headers="headers" :sort-by="sortBy"
        @view="viewCallback" @delete="deleteCallback" @edit="editCallback" @create="createCallback" />
</template>

<script setup>
    import { computed, ref } from 'vue';
    import { router } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';

    const props = defineProps({
        languages: {
            type: Array,
            required: true,
        }
    });

    const itemsPerPage = ref(10);

    const items = computed(() => {
        return props.languages;
    });

    const headers = [
        {
            title: 'Name',
            align: 'start',
            sortable: true,
            key: 'name',
        },
        {
            title: 'Code',
            align: 'start',
            sortable: true,
            key: 'code',
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

    const sortBy = ref([
        {
            key: 'name',
            direction: 'asc',
        },
        {
            key: 'code',
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
        router.get(route('dashboard.languages.show', {
            language: item.id,
        }));
    };

    const editCallback = (item) => {
        router.get(route('dashboard.languages.edit', {
            language: item.id,
        }));
    };

    const deleteCallback = (item) => {
        router.get(route('dashboard.languages.delete', {
            language: item.id,
        }));
    };

    const createCallback = () => {
        router.get(route('dashboard.languages.create'));
    };
</script>
