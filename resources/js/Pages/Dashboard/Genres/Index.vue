<template>
    <data-table-server
        :showNo="true"
        :title="__('Genres')"
        :createButtonText="__('New Genre')"
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
        emptyStateText="No genres found in the database"
        :emptyStateAction="true"
        emptyStateActionText="Add First genre"
        @empty-action="createCallback"
        buttonVariant="outlined"
        viewTooltip="View genre Details"
        editTooltip="Edit genre Information"
        deleteTooltip="Delete this genre"
        titleClass="text-2xl font-bold text-primary mb-4"
        :hasFilter="false"
        tableClasses="elevation-2 rounded-lg"
        iconSize="small"
        deleteConfirmText="Are you sure you want to delete this genre? This action cannot be undone."
        toolbarColor="white"
        :showSelect="false"
    >
    </data-table-server>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import { visitModal } from "@inertiaui/modal-vue";
import { router, usePage } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import { __ } from "matice";
import { toast } from "vue3-toastify";

const props = defineProps({
    genres: {
        type: Object,
        required: true,
    },
});

const loading = ref(false);
const lastUpdated = ref(new Date().toLocaleString());
const page = ref(1);
const sortBy = ref([]);

const serverItems = computed(() => {
    return props.genres.data;
});
const totalItems = computed(() => {
    return props.genres.meta.total;
});

const itemsPerPage = computed(() => {
    return props.genres.per_page;
});

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
        sortable: true,
        key: "description",
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
        only: ["genres"],
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

const viewCallback = (item) => {
    visitModal(
        route("dashboard.genres.show", {
            genre: item.id,
        }),
        {
            method: "get",
            config: {
                slideover: false,
                position: "center",
                closeExplicitly: true,
                maxWidth: "2xl",
            },
        },
    );
};

const editCallback = (item) => {
    visitModal(
        route("dashboard.genres.edit", {
            genre: item.id,
        }),
        {
            method: "get",
            config: {
                slideover: true,
                position: "right",
                closeExplicitly: true,
                maxWidth: "2xl",
            },
        },
    );
};

const deleteCallback = (item) => {
    visitModal(
        route("dashboard.genres.delete", {
            genre: item.id,
        }),
        {
            config: {
                slideover: false,
                position: "center",
                closeExplicitly: true,
                maxWidth: "2xl",
            },
        },
    );
};

const createCallback = () => {
    visitModal(route("dashboard.genres.create"), {
        config: {
            slideover: true,
            position: "right",
            closeExplicitly: true,
            maxWidth: "2xl",
        },
    });
};

const importCallback = () => {
    visitModal(route("dashboard.genres.import.show"), {
        config: {
            slideover: false,
            closeExplicitly: true,
        },
    });
};

const exportCallback = () => {
    window.location.href = route("dashboard.genres.export");
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
        type: "success",
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
            notify(error);
        }
    },
    {
        deep: true,
    },
);
</script>
