<template>
    <div class="w-screen relative overflow-hidden flex justify-center align-center" style="height: 650px;">
        <div class="absolute inset-0 bg-image" :style="{ backgroundImage: `url(${images_url[active]?.image_url})` }"></div>
        <div class="absolute inset-0 bg-overlay"></div>
        <div class="relative z-10 w-full">
            <v-container fluid>
                <v-container>
                    <v-carousel height="500" v-model="active" hide-delimiter-background :show-arrows="false" cycle
                        interval="4000">
                        <v-carousel-item v-for="(image, index) in images_url" :key="index">
                            <v-img v-if="image && image.image_url" :src="image.image_url" cover class="rounded-[20px]"></v-img>
                        </v-carousel-item>
                    </v-carousel>
                </v-container>
            </v-container>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const active = ref(0);
const images_url = ref([]);

onMounted(async () => {
    try {
        const res = await axios.get('/api/v1/dashboard/banners');
        images_url.value = res.data.data;
    }
    catch (err) {
        console.error('Failed to fetch images url:', err);
    }
});
</script>

<style scoped>
.bg-image {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    transform: scale(1.1);
    filter: blur(15px);
    z-index: 0;
    height: 100%;
    width: 100%;
}

.bg-overlay {
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 1;
    height: 100%;
    width: 100%;
}
</style>
