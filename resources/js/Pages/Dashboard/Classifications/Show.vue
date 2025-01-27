<template>
  <Modal>
    <div>
      <h4 class="text-gray-600 mb-4">Show Classification</h4>
      <ul class="list-group">
        <li class="list-group-item text-gray-600">
          <span class="fw-semibold text-gray-600">Name: </span>
          {{ props.classification.name }}
        </li>
        <li class="list-group-item text-gray-600">
          <span class="fw-semibold text-gray-600">Description: </span>
          {{ props.classification.description }}
        </li>
      </ul>
    </div>
  </Modal>
</template>

<script setup>
  import { defineProps } from "vue";

  const props = defineProps({
    classification: {
      type: Object,
      required: true,
    },
  });
</script>
