<template>
    <data-table-server :showNo="true" :title="__('Countries')" :serverItems="serverItems" :items-length="totalItems"
        :headers="headers" :loading="loading" :server-items="serverItems" :items-per-page="itemsPerPage" item-value="id"
        @update:options="loadItems" :has-create="true" :has-import="true" :has-export="true" @view="viewCallback"
        @edit="editCallback" @delete="deleteCallback" @create="createCallback" @import="importCallback"
        @export="exportCallback" />
</template>

<script setup>
import { computed, ref, watch } from "vue";
import { visitModal } from "@inertiaui/modal-vue";
import { router, usePage } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import { __ } from 'matice';
import { toast } from 'vue3-toastify';

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
    return props.countries.total;
});

const itemsPerPage = computed(() => {
    return props.countries.per_page;
});

const loading = ref(false);

const headers = [
    {
        title: __('Name'),
        align: 'start',
        sortable: true,
        key: 'name',
    }
];


function loadItems({ page, itemsPerPage }) {
    router.reload({
        data: {
            page,
            itemsPerPage
        },
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

const page = usePage();

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
