<template>
    <div>
        <h4 class="text-gray-600">Create Movie</h4>
        <vee-form :validation-schema="schema" @submit.prevent="submitForm" v-slot="{ meta, setErrors }">

            <vee-field name="name" v-slot="{ field, errors }">
                <v-text-field v-bind="field" :error-messages="errors" v-model="form.name" :label="__('Name')"
                    variant="outlined"></v-text-field>
            </vee-field>

            <vee-field name="description" v-slot="{ field, errors }">
                <v-textarea v-bind="field" :error-messages="errors" v-model="form.description"
                    :label="__('Description')" variant="outlined"></v-textarea>
            </vee-field>

            <vee-field name="hall_type_id" v-slot="{ errors }">
                <v-autocomplete :error-messages="errors" v-model="form.hall_type_id" :label="__('Hall Type')"
                    variant="outlined" :items="hallTypes" item-title="name" item-value="id"></v-autocomplete>
            </vee-field>


            <vee-field name="hall_seat_types" v-slot="{ field, errors }">
                <v-select v-bind="field" :error-messages="errors" v-model="form.hall_seat_types"
                    :label="__('Seat Types')" variant="outlined" :items="seatTypes" item-title="name" item-value="id"
                    multiple></v-select>
            </vee-field>

            <template v-for="seatType in form.hall_seat_types" :key="seatType.id">
                <v-card :elevation="10">
                    <p>{{ seatType }}</p>
                    <vee-field name="name" v-slot="{ field, errors }">
                        <v-text-field v-bind="field" :error-messages="errors" v-model="form.name"
                            :label="__('Maximal Seat')" variant="outlined"></v-text-field>
                    </vee-field>

                    <vee-field name="a" v-slot="{ field, errors }">
                        <v-text-field v-bind="field" :error-messages="errors" v-model="form.name" :label="__('Name')"
                            variant="outlined"></v-text-field>
                    </vee-field>
                </v-card>
            </template>

            <v-btn @click="close" color="primary" :disabled="!meta.valid || form.processing" :loading="form.processing"
                @click.prevent="submitForm(setErrors)" block>Submit</v-btn>
        </vee-form>
    </div>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    import axios from 'axios';
    import { __ } from 'matice';
    import { onMounted, ref } from 'vue';
    import * as yup from 'yup';

    const schema = yup.object().shape({
        // title: yup.string().required(__('title is required')),
        // release_date: yup.date()
        //     .required(__('release date is required'))
        //     .max(new Date(), __('release date cannot be in the future')),
        // duration: yup.number().required(__('duration is required')),
        // rating: yup.number().min(1, __('rating must be at least 1')).max(10, __('rating must be at most 10')).required(__('rating is required')).typeError(__('rating must be a number')),
        // country_id: yup.number().required(__('country is required')),
        // movieGenres: yup.array().of(yup.number()).min(1, __('at least one genre is required')).required(__('genre is required')),
        // movieLanguages: yup.array().of(yup.number()).min(1, __('at least one language is required')).required(__('language is required')),
    });

    const props = defineProps({
        seatTypes: Array,
    });

    const form = useForm({
        hall_type_id: null,
        name: '',
        description: '',
        hall_seat_types: [],
        hall_seats: [],
    });

    const hallTypes = ref([]);

    const submitForm = () => {
        form.post(route('dashboard.halls.store'));
    }

    /**
     * Load Hall Types
     *
     * @returns {Promise<void>}
     */
    const loadHallTypes = async () => {
        try {
            const response = await axios.get('http://cinema-booking-systems.test/api/v1/dashboard/hall_types', {
                headers: {
                    'Accept': 'application/json',
                }
            });

            if (response.data) {
                hallTypes.value = response.data;
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
        await Promise.all([
            loadHallTypes(),
        ]);
    });

</script>
