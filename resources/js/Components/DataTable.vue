<template>
    <v-data-table :headers="computedHeaders" :items="items" :sort-by="sortBy">
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>{{ title }}</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn @click="createItem()" class="mb-2" prepend-icon="mdi-plus" color="primary" variant="outlined">
                    New {{ title }}
                </v-btn>
            </v-toolbar>
        </template>

        <template v-slot:[`item.actions`]="{ item }">
            <v-icon class="me-3" color="primary" size="small" @click="viewItem(item)">
                mdi-eye
            </v-icon>
            <v-icon class="me-3" color="secondary" size="small" @click="editItem(item)">
                mdi-pencil
            </v-icon>
            <v-icon class="me-3" color="danger" size="small"  @click="deleteItem(item)">
                mdi-delete
            </v-icon>
        </template>
        <template v-slot:no-data>
            <p>There is no data to display</p>
        </template>
    </v-data-table>
</template>

<script setup>
    import { computed } from 'vue';

    const props = defineProps({
        title: {
            type: String,
            required: true,
        },
        items: {
            type: Array,
            required: true,
        },
        headers: {
            type: Array,
            required: true,
        },
        sortBy: {
            type: Array,
            default: () => [],
        },
    });

    const computedHeaders = computed(() => {
        return [
            ...props.headers,
            {
                title: 'Actions',
                align: 'start',
                sortable: false,
                value: 'actions',
            },
        ];
    });

    const emits = defineEmits(['view', 'edit', 'delete', 'create']);

    const viewItem = (item) => {
        emits('view', item);
    };

    const editItem = (item) => {
        emits('edit', item);
    };

    const deleteItem = (item) => {
        emits('delete', item);
    };

    const createItem = () => {
        emits('create');
    };
</script>
