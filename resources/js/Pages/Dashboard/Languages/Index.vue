<template>
    <data-table title="Language" :items="items" :headers="headers" :sort-by="sortBy" @view="viewCallback"
        @delete="deleteCallback" @edit="editCallback" />
</template>

<script setup>
    import { ref } from 'vue'

    const items = ref([
        {
            name: 'English',
            code: 'en',
            created_at: '2021-08-01',
            updated_at: '2021-08-01',
        },
        {
            name: 'Filipino',
            code: 'fil',
            created_at: '2021-08-02',
            updated_at: '2021-08-01',
        },
    ]);

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
</script>
