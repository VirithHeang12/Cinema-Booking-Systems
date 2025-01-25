<template>
    <data-table title="Country" :items="items" :headers="headers" :sort-by="sortBy" @view="viewCallback"
        @delete="deleteCallback" @edit="editCallback" @create="createCallback" />
</template>

<script setup>
    import { computed, ref } from 'vue'
    import { visitModal } from '@inertiaui/modal-vue';
    import { route } from 'ziggy-js';

    const props = defineProps({
        countries: {
            type: Array,
            required: true,
        }
    });

    const items = computed(() => {
        return props.countries;
    });

    const headers = [
        {
            title: 'Name',
            align: 'start',
            sortable: true,
            key: 'name',
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
            key: 'created_at',
            direction: 'asc',
        },
        {
            key: 'updated_at',
            direction: 'asc',
        }
    ]);

    const viewCallback = (item) => {
        visitModal(route('dashboard.countries.show', {
        country: item.id,
        }), {
            method: 'get',
            config: {
                slideover: false,
                position: 'center',
                closeExplicitly: true,
                maxWidth: 'xl',
            },
        });
    };

    const editCallback = (item) => {
        visitModal(route('dashboard.countries.edit', {
            country: item.id,
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
        visitModal(route('dashboard.countries.delete', {
            country: item.id,
        }), {
            config: {
                slideover: false,
                position: 'center',
                closeExplicitly: true,
                maxWidth: 'xl',

            },

        });

    };

    const createCallback = () => {
        visitModal(route('dashboard.countries.create'), {
            config: {
                slideover: true,
                position: 'right',
                closeExplicitly: true,
                maxWidth: '2xl',
            },

        });
    };
</script>
