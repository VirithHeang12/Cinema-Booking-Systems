<template>
    <div class="Language-list-container">
        <!-- Main table component -->
        <data-table-server :showNo="true" :title="__('Languages')" :createButtonText="__('New Language')"
            :serverItems="serverItems" :items-length="totalItems" :headers="headers" :loading="loading"
            :itemsPerPage="itemsPerPage" item-value="id" @update:options="loadItems" @view="viewCallback"
            @edit="editCallback" @delete="deleteCallback" @create="createCallback" @import="importCallback"
            @export="exportCallback" :emptyStateText="__('No Language found in the database')" :emptyStateAction="true"
            :emptyStateActionText="__('Add First Language')" @empty-action="createCallback" buttonVariant="outlined"
            :viewTooltip="__('View Language Details')" :editTooltip="__('Edit Language Information')"
            :deleteTooltip="__('Delete this Language')" titleClass="text-2xl font-bold text-primary mb-4"
            tableClasses="language-data-table elevation-2 rounded-lg" iconSize="small" :deleteConfirmText="__(
                'Are you sure you want to delete this language? This action cannot be undone.',
            )
                " toolbarColor="white" :showSelect="false">
        </data-table-server>
    </div>
</template>

<script setup>
    import { computed, ref } from "vue";
    import { visitModal } from "@inertiaui/modal-vue";
    import { router } from "@inertiajs/vue3";
    import { route } from "ziggy-js";
    import { __ } from "matice";


    const props = defineProps({
        languages: {
            type: Object,
            required: true,
        },
    });

    const serverItems = computed(() => {
        return props.languages.data;
    });
    const totalItems = computed(() => {
        return props.languages.total;
    });

    const itemsPerPage = computed(() => {
        return props.languages.per_page;
    });

    // State variables
    const loading = ref(false);
    const lastUpdated = ref(new Date().toLocaleString());
    const page = ref(1);
    const sortBy = ref([]);

    const headers = [
        {
            title: __("Name"),
            align: "start",
            sortable: true,
            key: "name",
        },
        {
            title: __("Code"),
            align: "start",
            sortable: false,
            key: "code",
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

    function loadItems(options) {
        loading.value = true;
        page.value = options.page;
        sortBy.value = options.sortBy;

        let sortKeyWithDirection =
            options.sortBy.length > 0 ? options.sortBy[0].key : null;

        if (sortKeyWithDirection) {
            sortKeyWithDirection =
                options.sortBy[0].order === "asc"
                    ? sortKeyWithDirection
                    : "-" + sortKeyWithDirection;
        }

        router.reload({
            data: {
                page: options.page,
                itemsPerPage: options.itemsPerPage,
                sort: sortKeyWithDirection,
                "filter[search]": options.search,
            },
            preserveState: true,
            only: ["languages"],
            onSuccess: () => {
                loading.value = false;
                lastUpdated.value = new Date().toLocaleString();
            },
            onError: () => {
                loading.value = false;
                notify("Failed to load data", "error");
            },
        });
    }

    /**
     *
     * Open the create language slideover
     *
     * @param item
     */
    const viewCallback = (item) => {
        visitModal(
            route("dashboard.languages.show", {
                language: item.id,
            }),
            {
                config: {
                    slideover: false,
                    closeExplicitly: true,
                },
            }
        );
    };


    /**
     * Open the edit language slideover
     *
     * @param item
     *
     * @return {void}
     */
    const editCallback = (item) => {
        visitModal(
            route("dashboard.languages.edit", {
                language: item.id,
            }),
        );
    };

    /**
     * Open the delete language slideover
     *
     * @param item
     *
     * @return {void}
     */
    const deleteCallback = (item) => {
        visitModal(
            route("dashboard.languages.delete", {
                language: item.id,
            }),
            {
                config: {
                    slideover: false,
                    closeExplicitly: true,
                },
            },
        );
    };

    /**
     * Open the create language slideover
     *
     * @return {void}
     */
    const createCallback = () => {
        visitModal(route("dashboard.languages.create"));
    };

    const importCallback = () => {
        visitModal(route("dashboard.languages.import.show"), {
            config: {
                slideover: false,
                closeExplicitly: true,
            },
        });
    };

    const exportCallback = () => {
        window.location.href = route("dashboard.languages.export");
    };
</script>
