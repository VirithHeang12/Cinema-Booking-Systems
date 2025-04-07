<template>
    <v-container class="!max-w-[1200px]">
        <div class="row my-3 gy-3">
            <TheMovieCard />
            <TheMovieCard />
            <TheMovieCard />
            <TheMovieCard />
            <TheMovieCard />
            <TheMovieCard />
        </div>

    </v-container>
</template>

<script setup>
import TheMovieCard from '@/Components/TheMovieCard.vue'
</script>
