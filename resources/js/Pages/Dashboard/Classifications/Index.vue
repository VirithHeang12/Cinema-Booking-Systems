<template>
    <data-table-server :showNo="true" :title="__('Classifications')" :createButtonText="__('New Classification')" :serverItems="serverItems"
        :items-length="totalItems" :headers="headers" :loading="loading" :itemsPerPage="itemsPerPage"
        item-value="id" @update:options="loadItems" @view="viewCallback" @edit="editCallback"
        @delete="deleteCallback" @create="createCallback" @import="importCallback" @export="exportCallback"
        emptyStateText="No classifications found in the database" :emptyStateAction="true"
        emptyStateActionText="Add First Classification" @empty-action="createCallback" buttonVariant="outlined"
        viewTooltip="View Classification Details" editTooltip="Edit Classification Information" deleteTooltip="Delete this Classification"
        titleClass="text-2xl font-bold text-primary mb-4" :hasFilter="false" tableClasses="elevation-2 rounded-lg" iconSize="small"
        deleteConfirmText="Are you sure you want to delete this classification? This action cannot be undone."
        toolbarColor="white" :showSelect="false">
    </data-table-server>
</template>

<script setup>
    import { computed, ref, watch } from "vue";
    import { visitModal } from "@inertiaui/modal-vue";
    import { router, usePage } from "@inertiajs/vue3";
    import { route } from "ziggy-js";
    import { __ } from 'matice';
    import { toast } from 'vue3-toastify';

    const props = defineProps({
        classifications: {
            type: Object,
            required: true,
        },
    });

    // State variables
    const loading = ref(false);
    const lastUpdated = ref(new Date().toLocaleString());
    const page = ref(1);
    const sortBy = ref([]);

    // Computed properties
    const serverItems = computed(() => {
        return props.classifications.data;
    });
    const totalItems = computed(() => {
        return props.classifications.meta.total;
    });

    const itemsPerPage = computed(() => {
        return props.classifications.per_page;
    });

    const headers = [
        {
            title: __('Name'),
            align: "start",
            sortable: true,
            key: "name",
            width: '250px',

        },
        {
            title: __('Description'),
            align: 'start',
            sortable: true,
            key: 'description'
        }
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
    function loadItems(options) {
        loading.value = true;
        page.value = options.page;
        sortBy.value = options.sortBy;

        let sortKeyWithDirection = options.sortBy.length > 0 ? options.sortBy[0].key : null;
        if (sortKeyWithDirection) {
            sortKeyWithDirection = options.sortBy[0].order === 'asc' ? sortKeyWithDirection : '-' + sortKeyWithDirection;
        }

        router.reload({
            data: {
                page: options.page,
                itemsPerPage: options.itemsPerPage,
                sort: sortKeyWithDirection,
                'filter[search]': options.search,
            },
            preserveState: true,
            only: ['classifications'],
            onSuccess: () => {
                loading.value = false;
                lastUpdated.value = new Date().toLocaleString();
            },
            onError: () => {
                loading.value = false;
                notify('Failed to load data', 'error');
            }
        });
    }


    const createCallback = () => {
        visitModal(route("dashboard.classifications.create"));
    };

    const viewCallback = (item) => {
        visitModal(route("dashboard.classifications.show", {
            classification: item.id,
        }));
    };

    const editCallback = (item) => {
        visitModal(route("dashboard.classifications.edit", {
            classification: item.id,
        }));
    };

    const deleteCallback = (item) => {
        visitModal(route("dashboard.classifications.delete", {
                classification: item.id,
            }), {
                config: {
                    slideover: false
                },
            }
        );
    };

    const importCallback = () => {
        visitModal(route("dashboard.classifications.import.show"), {
            config: {
                slideover: false,
                closeExplicitly: true,
            },
        });
    };

    const exportCallback = () => {
        window.location.href = route("dashboard.classifications.export");
    };

    /**
     * Notify the user
     *
     * @param {string} message
     *
     * @return void
     */
    const notify = (message) => {
        toast(message, {
            autoClose: 1500,
            position: toast.POSITION.BOTTOM_RIGHT,
            type: 'success',
            hideProgressBar: true,
        });
    }


    const p = usePage();
    /**
     * Watch for flash messages
     *
     * @return void
     */
    watch(() => p.props.flash, (flash) => {
        const success = p.props.flash.success;
        const error = p.props.flash.error;

        if (success) {
            notify(success);
        } else if (error) {
            notify(error);
        }
    }, {
        deep: true,
    });
</script>
