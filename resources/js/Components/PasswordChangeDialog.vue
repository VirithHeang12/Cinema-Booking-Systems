<template>
    <v-dialog v-model="dialog" max-width="500" class="z-100" persistent>
        <v-card class="pa-6">
            <v-card-title class="text-h5 font-weight-bold mb-4">Change Password</v-card-title>

            <vee-form :validation-schema="schema" @submit.prevent="handleSubmit" v-slot="{ setErrors, validate }">
                <v-card-text>
                    <vee-field name="current_password" v-slot="{ field, errors }">
                        <v-text-field v-bind="field" v-model="form.current_password" label="Current Password"
                            :type="showCurrent ? 'text' : 'password'"
                            :append-inner-icon="showCurrent ? 'mdi-eye-off' : 'mdi-eye'"
                            @click:append-inner="showCurrent = !showCurrent" variant="outlined"
                            prepend-inner-icon="mdi-lock" :error-messages="errors" class="mb-4" hide-details="auto" />
                    </vee-field>

                    <vee-field name="new_password" v-slot="{ field, errors }">
                        <v-text-field v-bind="field" v-model="form.new_password" label="New Password"
                            :type="showNew ? 'text' : 'password'"
                            :append-inner-icon="showNew ? 'mdi-eye-off' : 'mdi-eye'"
                            @click:append-inner="showNew = !showNew" variant="outlined"
                            prepend-inner-icon="mdi-lock-check" :error-messages="errors" class="mb-4"
                            hide-details="auto" />
                    </vee-field>

                    <vee-field name="confirm_password" v-slot="{ field, errors }">
                        <v-text-field v-bind="field" v-model="form.confirm_password" label="Confirm Password"
                            :type="showConfirm ? 'text' : 'password'"
                            :append-inner-icon="showConfirm ? 'mdi-eye-off' : 'mdi-eye'"
                            @click:append-inner="showConfirm = !showConfirm" variant="outlined"
                            prepend-inner-icon="mdi-lock-check" :error-messages="errors" class="mb-2"
                            hide-details="auto" />
                    </vee-field>
                </v-card-text>

                <v-card-actions class="justify-end">
                    <v-btn text @click="dialog = false">Cancel</v-btn>
                    <v-btn color="primary" :loading="form.processing" :disabled="form.processing"
                        @click.prevent="handleSubmit(setErrors, validate)">
                        Change Password
                    </v-btn>
                </v-card-actions>
            </vee-form>
        </v-card>
    </v-dialog>
</template>

<script setup>
    import { ref } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import * as yup from 'yup';

    const dialog = defineModel('dialog', {
        type: Boolean,
        default: false,
    });

    const showCurrent = ref(false);
    const showNew = ref(false);
    const showConfirm = ref(false);

    const schema = yup.object().shape({
        current_password: yup.string().required('Current password is required'),
        new_password: yup.string().min(8, 'Password must be at least 8 characters').required('New password is required'),
        confirm_password: yup
            .string()
            .oneOf([yup.ref('new_password')], 'Passwords must match')
            .required('Please confirm your new password'),
    });

    const form = useForm({
        current_password: '',
        new_password: '',
        confirm_password: '',
        processing: false,
    });

    const handleSubmit = async (setErrors, validate) => {
        const isValid = await validate();

        if (!isValid) return;

        form.processing = true;
        form.put(route('user-password.update'), {
            preserveScroll: true,
            onSuccess: () => {
                dialog.value = false;
                form.reset();
                form.processing = false; // Ensure this is properly set to false after success
            },
            onError: (errors) => {
                setErrors(errors);
                form.processing = false; // Make sure this is also set in case of error
            },
        });
    }

</script>
