<template>
    <Modal v-slot="{ close }">
        <div>
            <h4 class="text-gray-600">Create Movie</h4>
            <form @submit.prevent="submitForm">
                <div class="form-group">
                    <label for="name" class="text-gray-600">Name</label>
                    <input type="text" v-model="form.name" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="country_id" class="text-gray-600">Country</label>
                    <v-select v-model="form.country_id" :items="countries" item-value="id" item-title="name"></v-select>
                </div>
                <button type="submit" @click="close" class="btn btn-primary mt-5 text-white">Submit</button>
            </form>
        </div>
    </Modal>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    import axios from 'axios';
    import { onMounted, ref } from 'vue';

    const form = useForm({
        title: '',
        description: '',
        release_date: '',
        duration: '',
        rating: '',
        trailer_url: '',
        thumbnail_url: '',
        production_company_id: '',
        country_id: null,
        movieGenres: [],
        movieLanguages: [],
    });

    const countries = ref([]);

    const submitForm = () => {
        form.post(route('dashboard.countries.store'));
    }

    /**
     * Load countries
     *
     * @returns {Promise<void>}
     */
    const loadCountries = async () => {
        try {
            const response = await axios.get('http://cinema-booking-systems.test/api/v1/dashboard/countries', {
                headers: {
                    'Accept': 'application/json',
                }
            });

            if (response.data) {
                countries.value = response.data;
            }
        } catch (error) {
            console.error(error);
        }
    }

    /**
     * on mounted
     *
     * @returns {Promise<void>}
     */
    onMounted(async () => {
        await loadCountries();
    });

</script>
