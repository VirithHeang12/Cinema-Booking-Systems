<template>
    <Modal v-slot="{ close }">
      <div class="container d-flex flex-column align-items-center">
        <h1 class="fw-semibold mb-4 !text-zinc-800">Import HallType</h1>
        <form @submit.prevent="submitForm" class="col-12">
          <div class="mb-3">
            <label for="file" class="form-label">Please select spreadsheet file:</label>
            <input
              type="file"
              class="form-control"
              ref="fileInput"
              id="file"
              name="file"
              accept=".xlsx,.csv"
            />
          </div>
          <button
            @click="close"
            type="submit"
            class="btn btn-primary px-5 float-end !font-medium !text-zinc-50">
            Upload
          </button>
        </form>
      </div>
    </Modal>
  </template>
  
  <script setup>
    import { ref } from "vue";
    import { useForm } from "@inertiajs/vue3";
  
    const form = useForm({
      file: null,
    });
    const fileInput = ref(null);
  
    const submitForm = () => {
      if (!fileInput.value?.files[0]) {
        alert("Please select a file before uploading.");
        return;
      }
      form.file = fileInput.value.files[0];
  
      form.post(route("dashboard.hall_types.import"));
    };
  </script>
  