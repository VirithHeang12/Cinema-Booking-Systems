<template>
    <Modal v-slot="{ close }">
        <div>
            <h1 class="text-lg font-semibold mb-4 text-primary-900 text-center">Are you sure you want to delete this ?</h1>
   
            <form @submit.prevent="submitForm">
              
                 
                    <button @click="close" class="btn btn-dark text-white w-full mt-4 bg-primary-800 round-[10px] px-9 py-2 hover:bg-gray-800">Delete</button>
                
                
            </form>
        </div>
    </Modal>
</template>

<script setup>
    import { defineProps } from 'vue';
    import { router } from '@inertiajs/vue3';

    const props = defineProps({
        genre: {
            type: Object,
            required: true,
        }
    });

    const submitForm = () => {
        router.delete(route('dashboard.genres.destroy', props.genre.id));
    }
</script>
