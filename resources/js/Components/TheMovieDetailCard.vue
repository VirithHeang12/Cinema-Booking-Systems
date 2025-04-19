<template>
    <div class="w-screen relative overflow-hidden flex justify-center align-center" style="height: 650px;">
        <div class="absolute inset-0 bg-image" :style="{ backgroundImage: 'url(' + movie.thumbnail_url + ')' }"></div>
        <div class="absolute inset-0 bg-overlay"></div>
        <div class="relative z-10 w-full">
            <v-container class="my-[30px] font-cus" v-if="movie">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card !rounded-[25px] min-h-[480px] md:!h-[480px] relative overflow-hidden !border-0">
                            <div class="gradient-bg"></div>
                            <div class="row g-0">
                                <div class="col-12 col-md-6 p-5 rounded-tl-[25px] rounded-bl-[25px] min-h-[480px] md:!h-[480px] !text-white"
                                    style="z-index: 2;">
                                    <h1 class="text-[45px] mb-0 fw-semibold">{{ movie.title }}</h1>
                                    <h4
                                        class="text-[30px] my-[20px] font-bold bg-gradient-to-r from-blue-600 to-blue-200 bg-clip-text text-transparent inline-block">
                                        2D
                                    </h4>
                                    <p class="d-flex">
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M4 19V6.2C4 5.0799 4 4.51984 4.21799 4.09202C4.40973 3.71569 4.71569 3.40973 5.09202 3.21799C5.51984 3 6.0799 3 7.2 3H16.8C17.9201 3 18.4802 3 18.908 3.21799C19.2843 3.40973 19.5903 3.71569 19.782 4.09202C20 4.51984 20 5.0799 20 6.2V17H6C4.89543 17 4 17.8954 4 19ZM4 19C4 20.1046 4.89543 21 6 21H20M9 7H15M9 11H15M19 17V21"
                                                    stroke="#CB0F15" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                        <span class="ms-2 text-[#bcbcbc]">Genres:</span>
                                        <span v-if="movie.movie_genres && movie.movie_genres.length">
                                            <span v-for="(movieGenre, index) in movie.movie_genres"
                                                :key="movieGenre.id">
                                                &nbsp;<strong>{{ movieGenre.genre?.name }}</strong>
                                                &nbsp;<span v-if="index < movie.movie_genres.length - 1">|</span>
                                            </span>
                                        </span>
                                        <span v-else>&nbsp;<strong>Not specified</strong></span>

                                    </p>
                                    <p class="d-flex">
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.8284 6.75736C12.3807 6.75736 12.8284 7.20507 12.8284 7.75736V12.7245L16.3553 14.0653C16.8716 14.2615 17.131 14.8391 16.9347 15.3553C16.7385 15.8716 16.1609 16.131 15.6447 15.9347L11.4731 14.349C11.085 14.2014 10.8284 13.8294 10.8284 13.4142V7.75736C10.8284 7.20507 11.2761 6.75736 11.8284 6.75736Z"
                                                    fill="#CB0F15"></path>
                                            </g>
                                        </svg>
                                        <span class="ms-2 text-[#bcbcbc]">Duration:</span> &nbsp;<strong>{{
                                            movie.duration }}</strong>
                                    </p>
                                    <p class="d-flex">
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M4.5 10V7C4.5 6.44772 4.94772 6 5.5 6H7.3125M4.5 10V20C4.5 20.5523 4.94772 21 5.5 21H18.5C19.0523 21 19.5 20.5523 19.5 20V10M4.5 10H19.5M19.5 10V7C19.5 6.44772 19.0523 6 18.5 6H16.2188M7.3125 6V3M7.3125 6H16.2188M16.2188 6V3"
                                                    stroke="#CB0F15" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M8 14L16 14" stroke="#CB0F15" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>

                                        <span class="ms-2 text-[#bcbcbc]">Release:</span>&nbsp;<strong>{{
                                            formatDate(movie.release_date) }}</strong>
                                    </p>
                                    <p class="d-flex">
                                        <svg fill="#cb0f15" width="24px" height="24px" viewBox="-2 -2 24 24"
                                            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin"
                                            class="jam jam-eye-close">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M15.398 7.23l1.472-1.472C18.749 6.842 20 8.34 20 10c0 3.314-4.958 5.993-10 6a14.734 14.734 0 0 1-3.053-.32l1.747-1.746c.426.044.862.067 1.303.066h.002c-.415 0-.815-.063-1.191-.18l1.981-1.982c.47-.202.847-.579 1.05-1.049l1.98-1.981A4 4 0 0 1 10.022 14C14.267 13.985 18 11.816 18 10c0-.943-1.022-1.986-2.602-2.77zm-9.302 3.645A4 4 0 0 1 9.993 6C5.775 5.985 2 8.178 2 10c0 .896.904 1.877 2.327 2.644L2.869 14.1C1.134 13.028 0 11.585 0 10c0-3.314 4.984-6.017 10-6 .914.003 1.827.094 2.709.262l-1.777 1.776c-.29-.022-.584-.035-.88-.038.282.004.557.037.823.096l-4.78 4.779zM19.092.707a1 1 0 0 1 0 1.414l-16.97 16.97a1 1 0 1 1-1.415-1.413L17.677.708a1 1 0 0 1 1.415 0z">
                                                </path>
                                            </g>
                                        </svg>
                                        <span class="ms-2 text-[#bcbcbc]">Classification:</span>&nbsp;<strong>{{
                                            movie.classification.name }}</strong>
                                    </p>
                                </div>
                                <div class="col-12 col-md-6 h-100">
                                    <div class="relative h-100">
                                        <img :src="movie.thumbnail_url" :alt="movie.title"
                                            class="absolute img-fluid rounded-tr-[25px] rounded-br-[25px] w-100 min-h-[480px] md:!h-[480px] img-cus object-cover" />
                                        <div class="w-100 h-100">
                                            <v-btn v-if="!dialog" @click="dialog = true" elevation="4"
                                                class="bg-red absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
                                                icon="mdi-play"></v-btn>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </v-container>
        </div>
    </div>

    <v-dialog v-model="dialog" max-width="700" height="400" class="z-100">
        <v-card>
            <div v-if="movie.trailer_url" class="w-100 h-100 overflow-hidden">
                <iframe :src="getYoutubeEmbedUrl(movie.trailer_url)" class="w-100 h-100" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
        </v-card>
    </v-dialog>
</template>
<script setup>
import { ref } from 'vue';

const dialog = ref(false)

const props = defineProps({
    movie: {
        type: Object,
        required: true
    }
})
console.log(props.movie)
// Format release date
const formatDate = (dateString) => {
    if (!dateString) return '';
    const date = new Date(dateString);

    const day = String(date.getDate()).padStart(2, '0');
    const month = date.toLocaleString('en-US', { month: 'short' });
    const year = date.getFullYear();

    return `${day} ${month} ${year}`;
};

/**
 * Convert a YouTube URL to an embed URL
 *
 * @param {string} url - The YouTube URL (can be various formats)
 * @return {string} - The embed URL
 */
const getYoutubeEmbedUrl = (url) => {
    if (!url) return '';

    // Extract video ID from different YouTube URL formats
    let videoId = '';

    // youtube.com/watch?v=VIDEO_ID format
    if (url.includes('youtube.com/watch')) {
        const urlParams = new URLSearchParams(new URL(url).search);
        videoId = urlParams.get('v');
    }
    // youtu.be/VIDEO_ID format
    else if (url.includes('youtu.be')) {
        videoId = url.split('youtu.be/')[1];
    }
    // youtube.com/embed/VIDEO_ID format
    else if (url.includes('/embed/')) {
        videoId = url.split('/embed/')[1];
    }

    // Remove any additional parameters
    if (videoId && videoId.includes('&')) {
        videoId = videoId.split('&')[0];
    }

    if (videoId && videoId.includes('?')) {
        videoId = videoId.split('?')[0];
    }

    // Return the embed URL
    return videoId ? `https://www.youtube.com/embed/${videoId}` : '';
};
</script>
<style scoped>
.gradient-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 63%;
    height: 100%;
    background: linear-gradient(to right, #000000 80%, rgba(102, 102, 102, 0));
    z-index: 1;
}

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

@media (max-width: 768px) {
    .gradient-bg {
        width: 100%;
        height: 70%;
        background: linear-gradient(to bottom, #000000 80%, rgba(102, 102, 102, 0));
    }
}

@media (min-width: 768px) and (max-width: 1200px) {

    .card,
    .img-cus {
        min-height: 550px;
    }
}
</style>
