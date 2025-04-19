<template>
    <div class="w-screen relative overflow-hidden flex justify-center align-center" style="height: 650px;">
        <div class="absolute inset-0 bg-image"
            :style="{ backgroundImage: imageUrls.length && active >= 0 ? `url(${imageUrls[active]?.image_url})` : 'none' }">
        </div>
        <div class="absolute inset-0 bg-overlay"></div>
        <div class="relative z-10 w-full">
            <v-container fluid>
                <v-container>
                    <v-carousel height="500" v-model="active" hide-delimiter-background :show-arrows="false" cycle
                        interval="4000">
                        <v-carousel-item v-for="(image, index) in imageUrls" :key="index">
                            <v-img v-if="image && image.image_url" :src="image.image_url" cover class="rounded-[20px]"
                                height="500"></v-img>
                        </v-carousel-item>
                    </v-carousel>
                </v-container>
            </v-container>
        </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue';

    const active = ref(0);

    /**
     * Props for the SlideBanner component.
     *
     * @type {Array<{image_url: string}>}
     */
    defineProps({
        imageUrls: {
            type: Array,
            default: () => [],
        },
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
