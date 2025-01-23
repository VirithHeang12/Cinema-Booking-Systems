<template>
    <data-table title="Screen Type" :items="items" :headers="headers" :sort-by="sortBy" @view="viewCallback"
        @delete="deleteCallback" @edit="editCallback" @create="createCallback" />
</template>

<script setup>
import { computed, ref } from 'vue'
import { visitModal } from '@inertiaui/modal-vue';
import { route } from 'ziggy-js';

const props = defineProps({
    screenTypes: {
        type: Array,
        required: true,
    }
});

const items = computed(() => {
    return props.screenTypes;
});

const headers = [
    {
        title: 'Name',
        align: 'start',
        sortable: true,
        key: 'name',
    },
    {
        title: 'Description',
        aligh: 'start',
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
    console.log('Viewing item', item);
};

const editCallback = (item) => {
    console.log('Editing item', item);
};

const deleteCallback = (item) => {
    console.log('Deleting item', item);
};

const createCallback = () => {
    visitModal(route('dashboard.screen-types.create'), {
        config: {
            slideover: true,
            position: 'right',
        }
    });
};
</script>
