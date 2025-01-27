<template>
    <data-table title="HallType" :items="items" :headers="headers" :sort-by="sortBy" @view="viewCallback"
        @delete="deleteCallback" @edit="editCallback" @create="createCallback" />
</template>

<script setup>
    import { computed, ref } from 'vue'
    import { visitModal } from '@inertiaui/modal-vue';
    import { route } from 'ziggy-js';

    const props = defineProps({
        halltypes:{
            type: Array,
            required: true,
        }
    });

    const items = computed(() => {
        return props.halltypes;
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
        visitModal(route('dashboard.halltypes.show', {
            halltype: item.id,
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
        visitModal(route('dashboard.halltypes.edit', {
            halltype: item.id,
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
        visitModal(route('dashboard.halltypes.delete', {
            halltype: item.id,
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
        visitModal(route('dashboard.halltypes.create'), {
            config: {
                slideover: true,
                position: 'right',
                closeExplicitly: true,
                maxWidth: '2xl',
            },

        });
    };
</script>
