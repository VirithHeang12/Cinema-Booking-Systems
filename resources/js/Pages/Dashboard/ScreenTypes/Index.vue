<template>
    <div class="screen-type-list-container">
        <!-- Main table component -->
        <data-table-server :showNo="true" :title="__('Screen Type')" :createButtonText="__('New ScreenType')"
            :serverItems="serverItems" :items-length="totalItems" :headers="headers" :loading="loading"
            :itemsPerPage="itemsPerPage" item-value="id" @update:options="loadItems" @view="viewCallback"
            @edit="editCallback" @delete="deleteCallback" @create="createCallback" @import="importCallback"
            @export="exportCallback" :emptyStateText="__('No screen type found in the database')"
            :emptyStateAction="true" :emptyStateActionText="__('Add First Screen Type')" @empty-action="createCallback"
            buttonVariant="outlined" :viewTooltip="__('View Screen Type Details')"
            :editTooltip="__('Edit Screen Type Information')" :deleteTooltip="__('Delete this Screen Type')"
            titleClass="text-2xl font-bold text-primary mb-4" @filter-apply="applyFilters" @filter-clear="clearFilters"
            tableClasses="movie-data-table elevation-2 rounded-lg" iconSize="small" :deleteConfirmText="__(
                'Are you sure you want to delete this screen type? This action cannot be undone.',
            )
                " toolbarColor="white" :showSelect="false">
        </data-table-server>
    </div>
</template>

<script setup>
    import { ref, computed } from "vue";
    import { __ } from "matice";
    import { route } from "ziggy-js";
    import { router } from "@inertiajs/vue3";
    import { visitModal } from "@inertiaui/modal-vue";

    const props = defineProps({
        screen_types: {
            type: Object,
            required: true,
        },
    });

    // State variables
    const loading = ref(false);
    const page = ref(1);
    const sortBy = ref([]);

    // Computed properties
    const serverItems = computed(() => {
        return props.screen_types.data;
    });

    const totalItems = computed(() => {
        return props.screen_types.meta.total;
    });

    const itemsPerPage = computed(() => {
        return props.screen_types.per_page;
    });

    // Table headers definition
    const headers = [
        {
            title: __("Name"),
            align: "start",
            sortable: true,
            key: "name",
        },
        {
            title: __("Description"),
            align: "start",
            sortable: false,
            key: "description",
        },
    ];

    /**
     * Load items from the server
     *
     * @param options
     *
     * @return void
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
            only: ["screen_types"],
            onSuccess: () => {
                loading.value = false;
            },
            onError: () => {
                loading.value = false;
                notify("Failed to load data", "error");
            },
        });
    }

    function applyFilters() {
        loadItems({
            page: 1,
            itemsPerPage: itemsPerPage.value,
            sortBy: sortBy.value,
        });
    }

    /**
     * Clear all filters
     *
     * @return void
     */
    function clearFilters() {
        filterCountry.value = null;
        filterClassification.value = null;
        filterYear.value = null;
        loadItems({
            page: 1,
            itemsPerPage: itemsPerPage.value,
            sortBy: sortBy.value,
        });
    }

    /**
     * Open the create movie slideover
     *
     * @return void
     */
    const createCallback = () => {
        visitModal(route("dashboard.screen_types.create"));
    };

    /**
     * Open the view movie slideover
     *
     * @param item
     *
     * @return void
     */
    const viewCallback = (item) => {
        visitModal(
            route("dashboard.screen_types.show", {
                screen_type: item.id,
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
     * Open the edit movie slideover
     *
     * @param item
     *
     * @return void
     */
    const editCallback = (item) => {
        visitModal(
            route("dashboard.screen_types.edit", {
                screen_type: item.id,
            }),
        );
    };

    /**
     * Show the delete confirmation dialog
     *
     * @param item
     *
     * @return void
     */
    const deleteCallback = (item) => {
        visitModal(
            route("dashboard.screen_types.delete", {
                screen_type: item.id,
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
     * Open the import screen_types slideover
     *
     * @return void
     */
    const importCallback = () => {
        visitModal(route("dashboard.screen_types.import.show"), {
            config: {
                slideover: false,
                closeExplicitly: true,
            },
        });
    };

    /**
     * Export screen_types
     *
     * @return void
     */
    const exportCallback = () => {
        window.location.href = route("dashboard.screen_types.export");
    };
</script>
