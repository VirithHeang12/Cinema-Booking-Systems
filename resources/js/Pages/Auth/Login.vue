<template>
    <v-container fluid class="fill-height pa-0 ma-0">
        <v-row no-gutters class="fill-height ma-0">
            <!-- Left side with theater image -->
            <v-col cols="12" md="6" class="d-none d-md-block position-relative">
                <v-img src="/image/login-or-signup.jpg" height="100%" cover class="login-bg-image">
                    <!-- Overlay gradient -->
                    <div class="gradient-overlay"></div>
                </v-img>
            </v-col>

            <!-- Right side with login form -->
            <v-col cols="12" md="6" class="login-form-col">
                <v-card flat class="login-card pa-8 pa-sm-12">
                    <!-- Tab navigation -->
                    <div class="tabs-container mb-10">
                        <v-tabs v-model="activeTab" background-color="transparent" color="primary">
                            <v-tab value="login" class="text-h6 font-weight-bold">Log In</v-tab>
                            <v-tab value="signup" class="text-h6 font-weight-bold text-medium-emphasis">Sign
                                Up</v-tab>
                        </v-tabs>
                    </div>

                    <h2 class="text-h4 font-weight-bold mb-2">Welcome to Eternal!</h2>
                    <p class="text-subtitle-1 text-medium-emphasis mb-8" v-if="activeTab === 'login'">You can use your
                        email or phone number</p>
                    <p class="text-subtitle-1 text-medium-emphasis mb-8" v-else>Create your account to get started</p>

                    <!-- Login Form -->
                    <v-window v-model="activeTab">
                        <v-window-item value="login">
                            <vee-form :validation-schema="schema" @submit.prevent="submitForm"
                                v-slot="{ meta, setErrors, validate }" :validateOnBlur="true" :validateOnChange="false"
                                :validateOnInput="false">
                                <!-- Toggle between username and phone -->
                                <div class="toggle-container mb-6">
                                    <v-btn-toggle v-model="loginMethod" color="primary" mandatory rounded="pill"
                                        density="comfortable" variant="outlined" class="toggle-buttons">
                                        <v-btn value="email" rounded="pill" class="toggle-btn">Email</v-btn>
                                        <v-btn value="phone" rounded="pill" class="toggle-btn">Phone Number</v-btn>
                                    </v-btn-toggle>
                                </div>

                                <!-- Email Field -->
                                <vee-field v-if="loginMethod === 'email'" name="email" v-slot="{ field, errors }">
                                    <v-text-field v-bind="field" :error-messages="errors" v-model="form.email"
                                        label="Email" variant="outlined" prepend-inner-icon="mdi-email"
                                        density="comfortable" bg-color="surface" class="mb-4 login-input"
                                        hide-details="auto"></v-text-field>
                                </vee-field>

                                <!-- Phone Field -->
                                <vee-field v-else name="phone_number" v-slot="{ field, errors }">
                                    <v-text-field v-bind="field" :error-messages="errors" v-model="form.phone_number"
                                        label="Phone Number" variant="outlined" prepend-inner-icon="mdi-phone"
                                        density="comfortable" bg-color="surface" class="mb-4 login-input"
                                        hide-details="auto"></v-text-field>
                                </vee-field>

                                <!-- Password Field -->
                                <vee-field name="password" v-slot="{ field, errors }">
                                    <v-text-field v-bind="field" :error-messages="errors" v-model="form.password"
                                        label="Password" :type="showPassword ? 'text' : 'password'" variant="outlined"
                                        prepend-inner-icon="mdi-lock"
                                        :append-inner-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
                                        @click:append-inner="showPassword = !showPassword" density="comfortable"
                                        bg-color="surface" class="mb-2 login-input" hide-details="auto"></v-text-field>
                                </vee-field>

                                <!-- Remember Me and Forgot Password Row -->
                                <div class="d-flex justify-space-between align-center mb-8">
                                    <div>
                                        <v-checkbox v-model="rememberMe" hide-details class="mt-0 pt-0"
                                            density="compact">
                                            <template v-slot:label>
                                                <span class="text-body-2">Remember me</span>
                                            </template>
                                        </v-checkbox>
                                    </div>
                                    <div>
                                        <a href="#" class="text-decoration-none text-primary">Forgot password?</a>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <v-btn color="primary" block rounded="lg" size="large" height="48" elevation="0"
                                    :loading="form.processing" :disabled="form.processing"
                                    @click.prevent="submitForm(setErrors, validate)" class="login-btn mb-8">
                                    Continue
                                </v-btn>

                                <!-- Sign Up Link -->
                                <p class="text-center">
                                    Don't have an account?
                                    <a href="#" @click.prevent="activeTab = 'signup'"
                                        class="text-decoration-none text-primary font-weight-medium">
                                        Create account
                                    </a>
                                </p>
                            </vee-form>
                        </v-window-item>

                        <v-window-item value="signup">
                            <!-- Sign Up form implementation -->
                            <vee-form :validation-schema="signupSchema" @submit.prevent="submitSignupForm"
                                v-slot="{ setErrors, validate, meta }" :validateOnBlur="true" :validateOnChange="false"
                                :validateOnInput="false" class="mt-[5px]">

                                <!-- Name Field -->
                                <vee-field name="name" v-slot="{ field, errors }">
                                    <v-text-field v-bind="field" :error-messages="errors" v-model="signupForm.name"
                                        label="Full Name" variant="outlined" prepend-inner-icon="mdi-account"
                                        density="comfortable" bg-color="surface" class="mb-4 login-input"
                                        placeholder="John Doe" hide-details="auto"></v-text-field>
                                </vee-field>

                                <!-- Email Field -->
                                <vee-field name="signupEmail" v-slot="{ field, errors }">
                                    <v-text-field v-bind="field" :error-messages="errors" v-model="signupForm.email"
                                        label="Email" variant="outlined" prepend-inner-icon="mdi-email"
                                        density="comfortable" bg-color="surface" class="mb-4 login-input"
                                        placeholder="johndoe@gmail.com" hide-details="auto"></v-text-field>
                                </vee-field>

                                <!-- Phone Field -->
                                <vee-field name="phone_number" v-slot="{ field, errors }">
                                    <v-text-field v-bind="field" :error-messages="errors"
                                        v-model="signupForm.phone_number" label="Phone Number" variant="outlined"
                                        prepend-inner-icon="mdi-phone" density="comfortable" bg-color="surface"
                                        placeholder="+85596550123" class="mb-4 login-input"
                                        hide-details="auto"></v-text-field>
                                </vee-field>

                                <!-- Password Fields Row -->
                                <v-row>
                                    <v-col cols="12" sm="6">
                                        <!-- Password Field -->
                                        <vee-field name="signupPassword" v-slot="{ field, errors }">
                                            <v-text-field v-bind="field" :error-messages="errors"
                                                v-model="signupForm.password" label="Password"
                                                :type="showSignupPassword ? 'text' : 'password'" variant="outlined"
                                                prepend-inner-icon="mdi-lock"
                                                :append-inner-icon="showSignupPassword ? 'mdi-eye-off' : 'mdi-eye'"
                                                @click:append-inner="showSignupPassword = !showSignupPassword"
                                                density="comfortable" bg-color="surface" class="login-input"
                                                hide-details="auto"></v-text-field>
                                        </vee-field>
                                    </v-col>
                                    <v-col cols="12" sm="6">
                                        <!-- Password Confirmation Field -->
                                        <vee-field name="password_confirmation" v-slot="{ field, errors }">
                                            <v-text-field v-bind="field" :error-messages="errors"
                                                v-model="signupForm.password_confirmation" label="Confirm Password"
                                                :type="showConfirmPassword ? 'text' : 'password'" variant="outlined"
                                                prepend-inner-icon="mdi-lock-check"
                                                :append-inner-icon="showConfirmPassword ? 'mdi-eye-off' : 'mdi-eye'"
                                                @click:append-inner="showConfirmPassword = !showConfirmPassword"
                                                density="comfortable" bg-color="surface" class="login-input"
                                                hide-details="auto"></v-text-field>
                                        </vee-field>
                                    </v-col>
                                </v-row>
                                <div class="mb-6"></div>

                                <!-- Submit Button -->
                                <v-btn color="primary" block rounded="lg" size="large" height="48" elevation="0"
                                    :disabled="!meta.valid || signupForm.processing" :loading="signupForm.processing"
                                    @click.prevent="submitSignupForm(setErrors, validate)" class="login-btn mb-8">
                                    Create Account
                                </v-btn>

                                <!-- Login Link -->
                                <p class="text-center">
                                    Already have an account?
                                    <a href="#" @click.prevent="activeTab = 'login'"
                                        class="text-decoration-none text-primary font-weight-medium">
                                        Log in
                                    </a>
                                </p>
                            </vee-form>
                        </v-window-item>
                    </v-window>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup>
    import { ref, watch } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import * as yup from 'yup';
    import { route } from 'ziggy-js';

    const activeTab = ref('login');
    const loginMethod = ref('email');
    const showPassword = ref(false);
    const showSignupPassword = ref(false);
    const showConfirmPassword = ref(false);
    const rememberMe = ref(false);

    // Login schema (original)
    const schema = yup.object().shape({
        email: yup
            .string()
            .test(
                'conditional-required',
                'Email is required',
                (value, context) => {
                    return !(loginMethod.value === 'email') || (value && value.length > 0);
                }
            )
            .email('Must be a valid email'),
        phone_number: yup
            .string()
            .test(
                'conditional-required',
                'Phone number is required',
                (value, context) => {
                    return !(loginMethod.value === 'phone') || (value && value.length > 0);
                }
            )
            .matches(/^\+[1-9]\d{1,14}$/, 'Phone number must follow E.164 format (e.g., +85596550123)'),
        password: yup.string().min(8, 'Password must be at least 8 characters').required('Password is required'),
    });

    // Sign up schema
    const signupSchema = yup.object().shape({
        name: yup.string().required('Full name is required'),
        signupEmail: yup
            .string()
            .required('Email is required')
            .email('Must be a valid email'),
        phone_number: yup
            .string()
            .required('Phone number is required')
            .matches(/^\+[1-9]\d{1,14}$/, 'Phone number must follow E.164 format (e.g., +85596550123)'),
        signupPassword: yup
            .string()
            .min(8, 'Password must be at least 8 characters')
            .required('Password is required'),
        password_confirmation: yup
            .string()
            .oneOf([yup.ref('signupPassword')], 'Passwords must match')
            .required('Password confirmation is required'),
    });

    // Original login form
    const form = useForm({
        email: '',
        phone_number: '',
        password: '',
        remember: false,
    });

    // New signup form
    const signupForm = useForm({
        name: '',
        email: '',
        phone_number: '',
        password: '',
        password_confirmation: '',
    });

    // Login form submission (original)
    const submitForm = async (setErrors, validate) => {
        // Validate all fields manually before submission
        const isValid = await validate();

        if (isValid) {
            form.remember = rememberMe.value;
            form.post(route('login.store'), {
                onError: (errors) => {
                    console.error(errors);
                    setErrors(errors);
                },
            });
        }
    };

    // Signup form submission
    const submitSignupForm = async (setErrors, validate) => {
        // Validate all fields manually before submission
        const isValid = await validate();

        if (isValid) {
            signupForm.processing = true;

            // Both email and phone are required

            signupForm.post(route('register.store'), {
                onSuccess: () => {
                    // Handle successful registration
                    signupForm.processing = false;
                },
                onError: (errors) => {
                    setErrors(errors);
                    signupForm.processing = false;
                },
            });
        }
    };

    // Watch for changes in login method (original)
    watch(
        () => loginMethod.value,
        () => {
            // Clear the field values when switching login method
            if (loginMethod.value === 'email') {
                form.phone_number = '';
            } else {
                form.email = '';
            }
        }
    );

    // No longer needed as we require both email and phone
</script>

<style scoped>
    .fill-height {
        min-height: 100vh;
    }

    .login-form-col {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
    }

    .login-card {
        max-width: 480px;
        width: 100%;
        margin: 0 auto;
        background-color: transparent !important;
    }

    .login-bg-image {
        position: relative;
    }

    .gradient-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.4) 100%);
        z-index: 1;
    }

    .neon-design {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .neon-svg {
        width: 80%;
        height: 80%;
    }

    .neon-path {
        stroke-linecap: round;
        stroke-linejoin: round;
        filter: drop-shadow(0 0 8px currentColor);
    }

    .green-neon {
        animation: neon-glow 3s infinite alternate;
    }

    .cyan-neon {
        animation: neon-glow 3s infinite alternate-reverse;
    }

    @keyframes neon-glow {
        from {
            filter: drop-shadow(0 0 2px currentColor) drop-shadow(0 0 4px currentColor);
            opacity: 0.8;
        }

        to {
            filter: drop-shadow(0 0 8px currentColor) drop-shadow(0 0 12px currentColor);
            opacity: 1;
        }
    }

    .toggle-container {
        display: flex;
        justify-content: center;
    }

    .toggle-buttons {
        width: 100%;
    }

    .toggle-btn {
        flex: 1;
    }

    .login-input :deep(.v-field__outline) {
        border-radius: 12px;
    }

    .login-btn {
        border-radius: 12px;
        font-weight: 600;
    }

    .tabs-container :deep(.v-tab--selected) {
        color: #000;
        font-weight: 600;
    }

    .tabs-container :deep(.v-tab:not(.v-tab--selected)) {
        opacity: 0.6;
    }

    .toggle-btn:not(:last-child) {
        margin-right: 15px;
    }

    @media (max-width: 600px) {
        .login-card {
            padding: 24px !important;
        }
    }
</style>
