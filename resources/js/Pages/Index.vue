<template>
    <data-table-server title="Language" :items="serverItems" :items-length="totalItems" :headers="headers"
        :loading="loading" :server-items="serverItems" :items-per-page="itemsPerPage" item-value="id"
        @update:options="loadItems" />
</template>

<script setup>
    import { computed, ref } from 'vue'

    const props = defineProps({
        languages: {
            type: Array,
            required: true,
        }
    });

    console.log(props.languages);

    const serverItems = computed(() => {
        return props.languages.data;
    });
    const totalItems = computed(() => {
        return props.languages.total;
    });

    const itemsPerPage = computed(() => {
        return props.languages.per_page;
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
        console.log(page, itemsPerPage);
        // loading.value = true
        // FakeAPI.fetch({ page, itemsPerPage, sortBy }).then(({ items, total }) => {
        //     serverItems.value = items
        //     totalItems.value = total
        //     loading.value = false
        // })
    }
</script>
