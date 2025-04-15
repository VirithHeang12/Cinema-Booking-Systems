<template>
    <div class="screen-type-list-container">
        <!-- Main table component -->
        <data-table-server
            :showNo="true"
            :title="__('Screen Type')"
            :createButtonText="__('New ScreenType')"
            :serverItems="serverItems"
            :items-length="totalItems"
            :headers="headers"
            :loading="loading"
            :itemsPerPage="itemsPerPage"
            item-value="id"
            @update:options="loadItems"
            @view="viewCallback"
            @edit="editCallback"
            @delete="deleteCallback"
            @create="createCallback"
            @import="importCallback"
            @export="exportCallback"
            emptyStateText="No screen type found in the database"
            :emptyStateAction="true"
            emptyStateActionText="Add First Screen Type"
            @empty-action="createCallback"
            buttonVariant="outlined"
            viewTooltip="View Screen Type Details"
            editTooltip="Edit Screen Type Information"
            deleteTooltip="Delete this Screen Type"
            titleClass="text-2xl font-bold text-primary mb-4"
            @filter-apply="applyFilters"
            @filter-clear="clearFilters"
            tableClasses="movie-data-table elevation-2 rounded-lg"
            iconSize="small"
            deleteConfirmText="Are you sure you want to delete this movie? This action cannot be undone."
            toolbarColor="white"
            :showSelect="false"
        >
        </data-table-server>
    </div>
</template>

<script setup>
    import { ref, computed, watch } from "vue";
    import { __ } from "matice";
    import { route } from "ziggy-js";
    import { router, usePage } from "@inertiajs/vue3";
    import { toast } from "vue3-toastify";
    import { visitModal } from "@inertiaui/modal-vue";

    const props = defineProps({
        screen_types: {
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
            align: "center",
            sortable: true,
            key: "name",
            width: "150px",
        },
        {
            title: __("Description"),
            align: "center",
            sortable: false,
            key: "description",
            width: "180px",
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
                lastUpdated.value = new Date().toLocaleString();
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
            })
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
            })
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
            }),{
                config: {
                    slideover: false,
                    position: 'center',
                    closeExplicitly: true,
                    maxWidth: 'xl',
                    paddingClasses: 'p-4 sm:p-6',
                    panelClasses: 'bg-white rounded-[12px]',
                },
            }
        );
    };

    /**
     * Open the import screen_types slideover
     *
     * @return void
     */
    const importCallback = () => {
        visitModal(route("dashboard.screen_types.import.show"),{
                config: {
                    slideover: false,
                    position: 'center',
                    closeExplicitly: true,
                    maxWidth: 'xl',
                    paddingClasses: 'p-4 sm:p-6',
                    panelClasses: 'bg-white rounded-[12px]',
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

    /**
     * Notify the user
     *
     * @param {string} message
     * @param {string} type
     *
     * @return void
     */
    const notify = (message, type = "success") => {
        toast(message, {
            autoClose: 1500,
            position: toast.POSITION.BOTTOM_RIGHT,
            type: type,
            hideProgressBar: true,
        });
    };

    const p = usePage();

    /**
     * Watch for flash messages
     *
     * @return void
     */
    watch(
        () => p.props.flash,
        (flash) => {
            const success = p.props.flash.success;
            const error = p.props.flash.error;

            if (success) {
                notify(success);
            } else if (error) {
                notify(error, "error");
            }
        },
        {
            deep: true,
        }
    );
</script>


