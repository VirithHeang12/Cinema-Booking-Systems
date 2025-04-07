<template>
    <Modal v-slot="{ close }" :close-button="false">
        <form @submit.prevent="submitForm()">
            <div class="delete-modal-container">
                <div class="delete-icon-container">
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
                </div>

                <div class="delete-content">
                    <h3 class="delete-title">Delete Movie</h3>
                    <p class="delete-message">Are you sure you want to delete <span class="movie-title">{{ movie.title
                        || 'this movie' }}</span>?</p>
                    <p class="delete-warning">This action cannot be undone.</p>
                </div>

                <div class="delete-actions">
                    <button @click="close" class="cancel-button" type="button">
                        Cancel
                    </button>
                    <button type="submit" @click="close" class="delete-button">
                        Delete
                    </button>
                </div>
            </div>
        </form>
    </Modal>
</template>

<script setup>
    import { router } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';

    const props = defineProps({
        movie: {
            type: Object,
            required: true,
        }
    });

    /**
     * Submit the form to delete the movie.
     *
     * @returns {void}
     */
    const submitForm = () => {
        router.delete(route('dashboard.movies.destroy', props.movie.id));
    }
</script>

<style scoped>
    .delete-modal-container {
        padding: 2rem;
        text-align: center;
        position: relative;
        background-color: white;
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .delete-icon-container {
        margin-bottom: 1.5rem;
    }

    .delete-icon-circle {
        width: 80px;
        height: 80px;
        background-color: rgba(239, 68, 68, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .delete-icon-circle:hover {
        transform: scale(1.05);
        background-color: rgba(239, 68, 68, 0.15);
    }

    .delete-icon {
        width: 40px;
        height: 40px;
        color: #ef4444;
    }

    .delete-content {
        margin-bottom: 2rem;
    }

    .delete-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.75rem;
    }

    .delete-message {
        font-size: 1rem;
        color: #4b5563;
        margin-bottom: 0.5rem;
    }

    .movie-title {
        font-weight: 600;
        color: #1f2937;
    }

    .delete-warning {
        font-size: 0.875rem;
        color: #9ca3af;
        margin-top: 0.5rem;
    }

    .delete-actions {
        display: flex;
        gap: 1rem;
        margin-top: 0.5rem;
        width: 100%;
        justify-content: center;
    }

    .cancel-button {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.875rem;
        border: 1px solid #e5e7eb;
        background-color: white;
        color: #4b5563;
        transition: all 0.2s ease;
    }

    .cancel-button:hover {
        background-color: #f9fafb;
        color: #1f2937;
    }

    .delete-button {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.875rem;
        background-color: #ef4444;
        color: white;
        border: none;
        transition: all 0.2s ease;

    }

    .delete-button:hover {
        background-color: #dc2626;
        opacity: 0.9;
    }

    .delete-button:active {
        opacity: 1;
    }

    /* Additional styles for your im-modal-content */
    :deep(.im-modal-content) {
        padding: 0 !important;
        border-radius: 16px !important;
        background-color: white !important;
        box-shadow: none !important;
        overflow: hidden !important;
        max-width: 450px !important;
        width: 90% !important;
        margin: 0 auto !important;
    }
</style>
