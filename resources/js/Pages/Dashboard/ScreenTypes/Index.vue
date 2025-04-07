<!-- <template>
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
    visitModal(route('dashboard.screen-types.show', {
        screen_type: item.id,
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
    visitModal(route('dashboard.screen-types.edit', {
        screen_type: item.id,
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
    visitModal(route('dashboard.screen-types.delete', {
        screen_type: item.id
    }), {
        config: {
            slideover: false,
            position: 'center',
            closeExplicitly: true,
            maxWidth: '2xl',
        },
    })
};

const createCallback = () => {
    visitModal(route('dashboard.screen-types.create'), {
        config: {
            slideover: true,
            position: 'right',
            maxWidth: '2xl',
        }
    });
};
</script> -->

<!-- <template>
    <data-table-server :showNo="true" title="ScreenType" :serverItems="serverItems" :items-length="totalItems"
        :headers="headers" :loading="loading" :items-per-page="itemsPerPage" item-value="id" @update:options="loadItems"
        :has-create="true" :has-import="true" :has-export="true" @view="viewCallback" @delete="deleteCallback"
        @edit="editCallback" @create="createCallback" @import="importCallback" @export="exportCallback" />
</template>

<script setup>
    import { computed, ref } from 'vue'
    import { router } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';
    import { visitModal } from '@inertiaui/modal-vue';

    const props = defineProps({
        screenTypes: {
            type: Object,
            required: true,
        }
    });

    const serverItems = computed(() => {
        return props.screenTypes?.data || [];
    });
    const totalItems = computed(() => {
        return props.screenTypes?.total || 0;
    });

    const itemsPerPage = computed(() => {
        return props.screenTypes?.per_page || 10;
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
            title: 'Description',
            align: 'start',
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
        router.reload({
            data: {
                page,
                itemsPerPage,
            },
        });
    }

    const viewCallback = (item) => {
        visitModal(route('dashboard.screen_types.show', {
            screen_type: item.id,
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
        visitModal(route('dashboard.screen_types.edit', {
            screen_type: item.id,
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
        visitModal(route('dashboard.screen_types.delete', {
            screen_type: item.id,
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
        visitModal(route('dashboard.screen_types.create'), {
            config: {
                slideover: true,
                position: 'right',
                closeExplicitly: true,
                maxWidth: '2xl',
            },

        });
    };

    const importCallback = () => {
        visitModal(route("dashboard.screen_types.import.show"), {
            config: {
                slideover: false,
                position: "center",
                closeExplicitly: true,
                maxWidth: "xl",
            },
        });
    };

    const exportCallback = () => {
        window.location.href = route("dashboard.screen_types.export");
    };
</script> -->

<template>
    <div class="screen-type-list-container">
        <!-- Main table component -->
        <data-table-server
            :showNo="true"
            title="Screen Type"
            createButtonText="New Screen Type"
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
            title: "Name",
            align: "center",
            sortable: true,
            key: "name",
            width: "150px",
        },
        {
            title: "Description",
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
            })
        );
    };

    /**
     * Open the import screen_types slideover
     *
     * @return void
     */
    const importCallback = () => {
        visitModal(route("dashboard.screen_types.import.show"));
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

<style scoped>
    .screen-type-list-container {
        width: 100%;
        padding: 24px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .filter-section {
        min-width: 300px;
        padding: 16px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    .movie-data-table :deep(.v-data-table__td) {
        padding-top: 14px !important;
        padding-bottom: 14px !important;
        font-size: 14px !important;
    }

    /* Custom styling for the data table */
    :deep(.v-data-table-server .v-data-table) {
        box-shadow: none;
        border-radius: 8px;
        overflow: hidden;
    }

    :deep(.v-data-table__tbody tr:hover) {
        background-color: rgba(66, 133, 244, 0.05);
    }

    :deep(.v-data-table__thead th) {
        background-color: #f5f5f5;
        font-weight: 600 !important;
        color: #333 !important;
        text-transform: none !important;
        letter-spacing: 0 !important;
    }

    :deep(.v-data-table__thead tr th:first-child) {
        border-top-left-radius: 8px;
    }

    :deep(.v-data-table__thead tr th:last-child) {
        border-top-right-radius: 8px;
    }

    :deep(.v-btn) {
        text-transform: none;
        letter-spacing: 0;
    }
</style>
