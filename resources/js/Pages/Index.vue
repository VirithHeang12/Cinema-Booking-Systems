<template>
    <v-container fluid class="d-flex align-center justify-center px-0 py-0 bg-[#242424]">
        <v-row class="row my-0 mx-0">
            <v-container class="py-0 px-0">
                <SlideBanner :image-urls="banners" />
            </v-container>
            <v-container :max-width="1200" class="px-5">
                <v-row dense class="gap-4">
                    <v-col cols="2" v-for="(date, index) in dateRange" :key="index" @click="selectDate(date)">
                        <date-button :date="date.toISOString()" :is-active="isSelectedDate(date)" />
                    </v-col>
                </v-row>
            </v-container>
            <v-container :max-width="1200" class="px-0">
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
    import { computed, ref } from 'vue';

    const props = defineProps({
        banners: {
            type: Array,
            default: () => [],
        },
        movies: {
            type: Array,
            default: () => [],
        },
    });

    const selected = ref(new Date());

    // Generate 4 consecutive days starting from today
    const dateRange = computed(() => {
        const result = [];
        const today = new Date();

        for (let i = 0; i < 4; i++) {
            const date = new Date(today);
            date.setDate(today.getDate() + i);
            result.push(date);
        }

        return result;
    });

    const selectDate = (date) => {
        selected.value = date;
    };

    const isSelectedDate = (date) => {
        return date.getDate() === selected.value.getDate() &&
            date.getMonth() === selected.value.getMonth() &&
            date.getFullYear() === selected.value.getFullYear();
    };
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
