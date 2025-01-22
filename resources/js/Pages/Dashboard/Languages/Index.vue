<template>
    <data-table title="Language" :items="items" :headers="headers" :sort-by="sortBy" @view="viewCallback"
        @delete="deleteCallback" @edit="editCallback" @create="createCallback" />
</template>

<script setup>
    import { computed, ref } from 'vue'
    import { router } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';

    const props = defineProps({
        languages: {
            type: Array,
            required: true,
        }
    });

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
            aligh: 'start',
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
        console.log('Viewing item', item);
    };

    const editCallback = (item) => {
        console.log('Editing item', item);
    };

    const deleteCallback = (item) => {
        console.log('Deleting item', item);
    };

    const createCallback = () => {
        router.get(route('dashboard.languages.create'));
    };
</script>
