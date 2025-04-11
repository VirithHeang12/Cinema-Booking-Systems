<template>
    <header>
        <v-app-bar :elevation="0" color="#242424f1" flat compact class="relative z-1 app-bar">
            <v-container fluid>
                <v-row class="d-flex justify-space-between align-center">
                    <v-col cols="6">
                        <a href="/" class="flex justify-start">
                            <img width="50" height="20" src="/public/logo/sample_logo.png" alt="">
                        </a>
                    </v-col>
                    <v-col cols="6" class="flex gap-2 align-center justify-end">
                        <!-- Language Switcher -->
                        <v-menu>
                            <template v-slot:activator="{ props }">
                                <v-btn color="white" dark v-bind="props" class="opacity-65 hover:opacity-100">
                                    <flag
                                        :iso="getLocale().toLowerCase() === 'en' ? 'gb' : getLocale().toLowerCase()" />
                                    <span class="ml-1 d-none d-md-block">{{ currentLocale }}</span>
                                    <v-icon class="ml-1 md:ml-0">mdi-chevron-down</v-icon>
                                </v-btn>
                            </template>
                            <v-list>
                                <v-list-item v-for="([key, value], index) in localizations" :key="index">
                                    <v-list-item-title>
                                        <v-btn @click="switchLocale(key)" :elevation="0" width="100%">
                                            <template #prepend>
                                                <flag
                                                    :iso="key.toLowerCase() === 'en' ? 'gb' : key.toLowerCase()" />
                                            </template>
                                            {{ value.native }}
                                        </v-btn>
                                    </v-list-item-title>
                                </v-list-item>
                            </v-list>
                        </v-menu>
                        
                        <!-- Account Dropdown -->
                        <v-menu offset-y>
                        <template v-slot:activator="{ props }">
                            <v-btn icon color="white" class="opacity-65 hover:opacity-100" v-bind="props">
                            <v-icon>mdi-account</v-icon>
                            </v-btn>
                        </template>

                        <v-list>
                            <v-list-item  v-if="!dialog"  @click="dialog = true">
                                <v-list-item-title>
                                    <v-icon start class="mr-2">mdi-lock-reset</v-icon>
                                    Change Password
                                </v-list-item-title>
                            </v-list-item>

                            <v-list-item @click="logout">
                                <v-list-item-title>
                                    <v-icon start class="mr-2">mdi-logout</v-icon>
                                    Logout
                                </v-list-item-title>
                            </v-list-item>
                        </v-list>
                        </v-menu>
                    </v-col>
                </v-row>
           </v-container>
        </v-app-bar>
    </header>

    <v-dialog v-model="dialog" max-width="500" class="z-100" persistent>
      <v-card class="pa-6">
        <v-card-title class="text-h5 font-weight-bold mb-4">Change Password</v-card-title>
  
        <vee-form :validation-schema="schema" @submit.prevent="handleSubmit" v-slot="{ setErrors, validate }">
          <v-card-text>
            <vee-field name="current_password" v-slot="{ field, errors }">
              <v-text-field
                v-bind="field"
                v-model="form.current_password"
                label="Current Password"
                :type="showCurrent ? 'text' : 'password'"
                :append-inner-icon="showCurrent ? 'mdi-eye-off' : 'mdi-eye'"
                @click:append-inner="showCurrent = !showCurrent"
                variant="outlined"
                prepend-inner-icon="mdi-lock"
                :error-messages="errors"
                class="mb-4"
                hide-details="auto"
              />
            </vee-field>
  
            <vee-field name="new_password" v-slot="{ field, errors }">
              <v-text-field
                v-bind="field"
                v-model="form.new_password"
                label="New Password"
                :type="showNew ? 'text' : 'password'"
                :append-inner-icon="showNew ? 'mdi-eye-off' : 'mdi-eye'"
                @click:append-inner="showNew = !showNew"
                variant="outlined"
                prepend-inner-icon="mdi-lock-check"
                :error-messages="errors"
                class="mb-4"
                hide-details="auto"
              />
            </vee-field>
  
            <vee-field name="confirm_password" v-slot="{ field, errors }">
              <v-text-field
                v-bind="field"
                v-model="form.confirm_password"
                label="Confirm Password"
                :type="showConfirm ? 'text' : 'password'"
                :append-inner-icon="showConfirm ? 'mdi-eye-off' : 'mdi-eye'"
                @click:append-inner="showConfirm = !showConfirm"
                variant="outlined"
                prepend-inner-icon="mdi-lock-check"
                :error-messages="errors"
                class="mb-2"
                hide-details="auto"
              />
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
    import { ref, computed } from 'vue';
    import { router, usePage, useForm } from '@inertiajs/vue3';
    import { __, getLocale, setLocale } from 'matice';
    import * as yup from 'yup'
    import { route } from 'ziggy-js'
    
    const dialog = ref(false)
    const showCurrent = ref(false)
    const showNew = ref(false)
    const showConfirm = ref(false)
    
    const schema = yup.object().shape({
        current_password: yup.string().required('Current password is required'),
        new_password: yup.string().min(8, 'Password must be at least 8 characters').required('New password is required'),
        confirm_password: yup
        .string()
        .oneOf([yup.ref('new_password')], 'Passwords must match')
        .required('Please confirm your new password'),
    })
    
    const form = useForm({
        current_password: '',
        new_password: '',
        confirm_password: '',
        processing: false,
    })

    const handleSubmit = async (setErrors, validate) => {
        const isValid = await validate()
        if (!isValid) return
    
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

    // Localization
    const localizations = ref(Object.entries(usePage().props.localizations));
    const currentLocale = computed(() => localizations.value.find(([key]) => key === getLocale())?.[1]?.code);

    const switchLocale = (key) => {
        setLocale(key);
        localizations.value = Object.entries(usePage().props.localizations);
        const [, { path }] = localizations.value.find(([key]) => key === getLocale());
        router.visit(path, { method: "get" });
    };

    const logout = () => {
        router.post(route('logout'));
    }
</script>
