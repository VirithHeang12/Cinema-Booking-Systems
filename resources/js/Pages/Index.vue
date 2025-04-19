<template>
    <v-container fluid class="d-flex align-center justify-center px-0 py-0">
        <v-row class="row my-0 mx-0">
            <v-container class="py-0 px-0">
                <SlideBanner :image-urls="banners" />
            </v-container>

            <v-container :max-width="1200" class="px-5 !mt-[50px]">
                <v-row dense class="gap-4">
                    <v-col cols="2" v-for="(date, index) in dateRange" :key="index" @click="selectDate(date)">
                        <date-button :date="date.toISOString()" :is-active="isSelectedDate(date)" />
                    </v-col>
                </v-row>
            </v-container>

            <v-container :max-width="1200" class="px-5 mt-10">
                <v-row dense>
                    <TheMovieCard :movies="movies" />
                </v-row>
            </v-container>
        </v-row>
    </v-container>
</template>

<script setup>
    import TheMovieCard from '@/Components/TheMovieCard.vue'
    import SlideBanner from '@/Components/SlideBanner.vue';
    import { computed, ref, watch } from 'vue';
    import { router } from '@inertiajs/vue3';

    const props = defineProps({
        banners: {
            type: Array,
            default: () => [],
        },
        movies: {
            type: Array,
            default: () => [],
        },
        days: {
            type: Array,
            default: () => [],
        }
    });

    const selected = ref(new Date(props.days[0].date));


    const dateRange = computed(() => {
        return props.days.map(day => new Date(day.date));
    });

    const selectDate = (date) => {
        selected.value = date;
    };

    const isSelectedDate = (date) => {
        return date.getDate() === selected.value.getDate() &&
            date.getMonth() === selected.value.getMonth() &&
            date.getFullYear() === selected.value.getFullYear();
    };

    /**
     * Fetch movies for a specific date
     *
     * @param date
     *
     * @returns {Promise<void>}
     */
    const fetchMovies = async (date) => {
        router.reload({
            data: {
                filter: {
                    date: date.toISOString(),
                }
            },
            preserveState: true,
            only: ['movies'],
        });
    };

    /**
     * Watch for changes in the selected date and refetch movies for that date
     *
     * @returns {void}
     */
    watch(selected, (newDate) => {
        fetchMovies(newDate);
    }, {
        immediate: true,
    });

</script>

<style scoped>
    .bg-blur::before {
        content: '';
        width: 65%;
        height: 100%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, 100%);
        background-color: red;
        filter: blur(200px);
        border-radius: 100%;
        z-index: -1;
    }

    .app-bar {
        position: relative;
        overflow: hidden;
        /* Ensure the gradient doesn't spill out */
    }

    .app-bar::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 1px;
        /* Thickness of the border */
        background: linear-gradient(to right,
                rgba(255, 255, 255, 0),
                /* Lighter left */
                rgba(255, 255, 255, 0.4),
                /* Darker center */
                rgba(255, 255, 255, 0)
                /* Lighter right */
            );
    }
</style>
