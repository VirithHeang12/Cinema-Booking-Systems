<template>
    <div class="movie-list-container">
        <data-table-server :showNo="true" :title="__('Countries')" :createButtonText="__('New Country')"
            :serverItems="serverItems" :items-length="totalItems" :headers="headers" :loading="loading"
            :server-items="serverItems" :items-per-page="itemsPerPage" item-value="id" @update:options="loadItems"
            :has-create="true" :has-import="true" :has-export="true" @view="viewCallback" @edit="editCallback"
            @delete="deleteCallback" @create="createCallback" @import="importCallback" @export="exportCallback"
            titleClass="text-2xl font-bold text-primary mb-4" iconSize="small" toolbarColor="white"
            buttonVariant="outlined" @filter-apply="applyFilters" />
    </div>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import { visitModal } from "@inertiaui/modal-vue";
import { router, usePage } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import { __ } from 'matice';
import { toast } from 'vue3-toastify';


const sortBy = ref([]);
const loading = ref(false);
const lastUpdated = ref(new Date().toLocaleString());
const props = defineProps({
    countries: {
        type: Object,
        required: true,
    }
});

const serverItems = computed(() => {
    return props.countries.data;
});

const totalItems = computed(() => {
    return props.countries.meta.total;
});

const itemsPerPage = computed(() => {
    return props.countries.per_page;
});


const headers = [
    {
        title: __('Name'),
        align: 'start',
        sortable: true,
        key: 'name',
        width: '250px',
    },
];

const page = usePage();


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
        only: ['countries'],
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

function applyFilters() {
    loadItems({
        page: 1,
        itemsPerPage: itemsPerPage.value,
        sortBy: sortBy.value,
    });
}

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
            paddingClasses: 'p-4 sm:p-6',
            panelClasses: 'bg-white rounded-[12px]',
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
            paddingClasses: 'p-4 sm:p-6',
            panelClasses: 'bg-white rounded-[12px]',
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

const importCallback = () => {
    visitModal(route("dashboard.countries.import.show"), {
        config: {
            slideover: false,
            position: "center",
            closeExplicitly: true,
            maxWidth: "xl",
            paddingClasses: 'p-4 sm:p-6',
        },
    });
};

const exportCallback = () => {
    window.location.href = route("dashboard.countries.export");
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
        progressStyle: {
            background: "oklch(0.707 0.022 261.325)",
            height: "5px",
        }
    });
}


/**
 * Watch for flash messages
 *
 * @return void
 */
watch(() => page.props.flash, (flash) => {
    const success = page.props.flash.success;
    const error = page.props.flash.error;

    if (success) {
        notify(success);
    } else if (error) {
        notify(error);
    }
}, {
    deep: true,
});

</script>


