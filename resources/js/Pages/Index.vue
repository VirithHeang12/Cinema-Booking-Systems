<template>
    <v-container fluid class="d-flex align-center justify-center px-0 py-0">
        <div class="row gy-3">
            <SlideBanner :image-urls="banners" />
            <TheMovieCard :movies="movies" />
        </div>
    </v-container>
</template>

<script setup>
    import TheMovieCard from '@/Components/TheMovieCard.vue'
    import SlideBanner from '@/Components/SlideBanner.vue';

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
</script>
