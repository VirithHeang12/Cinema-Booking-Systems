<template>
  <data-table-server
    :showNo="true"
    title="Classification"
    :serverItems="serverItems"
    :items-length="totalItems"
    :headers="headers"
    :loading="loading"
    :server-items="serverItems"
    :items-per-page="itemsPerPage"
    item-value="id"
    @update:options="loadItems"
    :has-create="true"
    :has-import="true"
    :has-export="true"
    @view="viewCallback"
    @delete="deleteCallback"
    @edit="editCallback"
    @create="createCallback"
    @import="importCallback"
    @export="exportCallback"
  />
</template>

<script setup>
  import { computed, ref } from "vue";
  import { visitModal } from "@inertiaui/modal-vue";
  import { router } from "@inertiajs/vue3";
  import { route } from "ziggy-js";

  const props = defineProps({
    classifications: {
      type: Object,
      required: true,
    },
  });

  const serverItems = computed(() => {
    return props.classifications.data;
  });
  const totalItems = computed(() => {
    return props.classifications.total;
  });

  const itemsPerPage = computed(() => {
    return props.classifications.per_page;
  });

  const loading = ref(false);

  const headers = [
    {
      title: "Name",
      align: "start",
      sortable: true,
      key: "name",
    },
    {
      title: "Created At",
      align: "start",
      sortable: true,
      key: "created_at",
    },
    {
      title: "Updated At",
      align: "start",
      sortable: true,
      key: "updated_at",
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
    visitModal(
      route("dashboard.classifications.show", {
        classification: item.id,
      }),
      {
        method: "get",
        config: {
          slideover: false,
          position: "center",
          maxWidth: "xl",
        },
      }
    );
  };

  const editCallback = (item) => {
    visitModal(
      route("dashboard.classifications.edit", {
        classification: item.id,
      }),
      {
        method: "get",
        config: {
          slideover: true,
          position: "right",
          closeExplicitly: true,
          maxWidth: "xl",
        },
      }
    );
  };

  const deleteCallback = (item) => {
    visitModal(
      route("dashboard.classifications.delete", {
        classification: item.id,
      }),
      {
        config: {
          slideover: false,
          position: "center",
          maxWidth: "xl",
        },
      }
    );
  };

  const createCallback = () => {
    visitModal(route("dashboard.classifications.create"), {
      config: {
        slideover: true,
        position: "right",
        closeExplicitly: true,
        maxWidth: "xl",
      },
    });
  };

  const importCallback = () => {
    visitModal(route("dashboard.classifications.import.show"), {
      config: {
        slideover: false,
        position: "center",
        closeExplicitly: true,
        maxWidth: "xl",
      },
    });
  };

  const exportCallback = () => {
    window.location.href = route("dashboard.classifications.export");
  };
</script>
