<template>
    <Modal v-slot="{ close }" :close-button="false">
        <form @submit.prevent="submitForm()">
            <div class="delete-modal-container">
                <div class="flex gap-3 w-full">
                    <div class="delete-icon-circle">
                        <svg class="delete-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 12V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M14 12V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M4 7H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                            <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                    </div>
                    <div class="grid text-left">
                        <h3 class="font-semibold !text-zinc-800">{{ __('Delete Seat Type') }}</h3>
                        <p class="text-dm text-neutral-600 font-medium mb-1">
                            {{ __('Are you sure you want to delete') }}
                            <span class="!text-zinc-700 font-semibold">{{ seat_type.name || __("this seat type")
                            }}</span>?
                        </p>
                        <p class="text-[12.5px] text-neutral-500 mb-0">
                            {{ __('This action cannot be undone.') }}
                        </p>
                    </div>
                </div>

                <div class="w-full flex justify-between items-center gap-4 mt-5">
                    <button @click="close" class="cancel-button" type="button">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" @click="close" class="delete-button">
                        {{ __('Delete') }}
                    </button>
                </div>
            </div>
        </form>
    </Modal>
</template>

<script setup>
    import { router } from "@inertiajs/vue3";
    import { route } from "ziggy-js";

    const props = defineProps({
        seat_type: {
            type: Object,
            required: true,
        },
    });

    /**
     * Submit the form to delete the seat type
     *
     * @returns {void}
     */
    const submitForm = () => {
        router.delete(route("dashboard.seat_types.destroy", {
            seat_type: props.seat_type.id,
        }));
    };
</script>
