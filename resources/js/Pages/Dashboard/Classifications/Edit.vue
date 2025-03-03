<template>
    <Modal v-slot="{ close }">
        <div class="container mt-5 d-flex flex-column align-items-center">
            <h1 class="fw-semibold mb-3 text-zinc-800">Edit Classification</h1>
            <form @submit.prevent="submitForm" class="col-12">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" v-model="form.name" id="name" name="name"
                        placeholder="Enter name" />
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" v-model="form.description" id="description" name="description"
                        rows="3" placeholder="Enter description"></textarea>
                </div>
                <button type="submit" @click="close" class="btn btn-primary !font-medium !text-zinc-50">
                    Submit
                </button>
            </form>
        </div>
    </Modal>
</template>

<script setup>
    import { useForm } from "@inertiajs/vue3";

    const props = defineProps({
        classification: {
            type: Object,
            required: true,
        },
    });

    const form = useForm({
        name: props.classification.name,
        description: props.classification.description
    });

    const submitForm = () => {
        form.put(route("dashboard.classifications.update", props.classification.id));
    };
</script>
