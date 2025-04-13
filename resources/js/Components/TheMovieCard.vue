<template>
    <v-col cols="12" sm="6" md="3" v-for="(movie, index) in movies" :key="index">
        <Link href="/" class="relative">
        <div class="flex flex-col items-center justify-center">
            <img :src="movie.thumbnail_url" alt="" class="img-fluid object-cover !w-[250px] !h-[370px] rounded-[15px]" />
            <div class="absolute top-3 right-6">
                <span class="classification inline-flex items-center me-1 px-3 py-1 text-xs font-medium text-gray-200 ring-1 ring-gray-500/10 ring-inset">
                    {{movie.classification}}
                </span>
            </div>
            <div class="mt-2">
                <div class="d-flex align-center my-1">
                    <p class="text-md font-medium mb-0 text-gray-600">{{ formatDate(movie.release_date)
                                }}</p>

                </div>
                <div class="w-[250px] text-wrap overflow-hidden">
                    <h5 class="title font-medium text-zinc-700 hover:text-zinc-800 duration-200 ease-in-out line-clamp-2">
                        {{movie.title}}
                    </h5>
                </div>

            </div>

        </div>
        </Link>
    </v-col>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';

const movies = ref([]);

onMounted(async () => {
    try {
        const res = await axios.get('/api/v1/dashboard/movies');
        movies.value = res.data.items;
        console.log(movies.value[0].thumbnail_url);
    }
    catch (err) {
        console.error('Failed to fetch images url:', err);
    }
});

const formatDate = (dateString) => {
        if (!dateString) return '';
        const date = new Date(dateString);

        const day = String(date.getDate()).padStart(2, '0');
        const month = date.toLocaleString('en-US', { month: 'short' });
        const year = date.getFullYear();

        return `${day} ${month} ${year}`;
    };
</script>
<style scoped>
a {
    color: #000;
    text-decoration: none !important;
    font-weight: 500;
}
.classification{
    background: rgba(255, 255, 255, 0.15);
    border-radius: 15px!important;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}
</style>
