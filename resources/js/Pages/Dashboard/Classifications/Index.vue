<template>
  <data-table
    title="Classification"
    :items="items"
    :headers="headers"
    :sort-by="sortBy"
    @view="viewCallback"
    @delete="deleteCallback"
    @edit="editCallback"
    @create="createCallback"
  />
</template>

<script setup>
  import { computed, ref } from "vue";
  import { visitModal } from "@inertiaui/modal-vue";
  import { route } from "ziggy-js";

  const props = defineProps({
    classifications: {
      type: Array,
      required: true,
    },
  });

  const items = computed(() => {
    return props.classifications;
  });

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

  const sortBy = ref([
    {
      key: "name",
      direction: "asc",
    },
    {
      key: "created_at",
      direction: "asc",
    },
    {
      key: "updated_at",
      direction: "asc",
    },
  ]);

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
</script>
