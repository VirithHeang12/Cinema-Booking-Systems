<template>
  <div>
    <Head title="About" />
  </div>


    <v-container class="my-[30px] font-cus">
        <div class="row">
            <div class="col-12">
                <img src="/public/image/banner_about.jpg" alt="" class="img-fluid w-100 h-[200px] rounded-[25px]" />
            </div>
        </div>
        <div class="row ">
            <div class="col-12">
                <v-breadcrumbs :items="items" class="px-0 mt-[15px] mb-0 text-[17px] text-gray-300">
                    <template v-slot:divider>
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M10.25 16.25C10.1493 16.2466 10.0503 16.2227 9.95921 16.1797C9.86807 16.1367 9.78668 16.0756 9.72001 16C9.57956 15.8594 9.50067 15.6688 9.50067 15.47C9.50067 15.2713 9.57956 15.0806 9.72001 14.94L12.72 11.94L9.72001 8.94002C9.66069 8.79601 9.64767 8.63711 9.68277 8.48536C9.71786 8.33361 9.79933 8.19656 9.91586 8.09322C10.0324 7.98988 10.1782 7.92538 10.3331 7.90868C10.4879 7.89198 10.6441 7.92391 10.78 8.00002L14.28 11.5C14.4205 11.6407 14.4994 11.8313 14.4994 12.03C14.4994 12.2288 14.4205 12.4194 14.28 12.56L10.78 16C10.7133 16.0756 10.6319 16.1367 10.5408 16.1797C10.4497 16.2227 10.3507 16.2466 10.25 16.25Z"
                                    fill="#757575"></path>
                            </g>
                        </svg>
                    </template>
                </v-breadcrumbs>

                <p class="text-gray-300 fw-semibold text-[32px]">{{__('aboutPage.title')}}</p>
                <p class="text-grey text-justify mt-[20px] text-[17px]">
                    {{ __('aboutPage.firstParagraph') }}
                 </p>
                 <p class="text-grey text-justify mt-[20px] text-[17px]">
                    {{ __('aboutPage.secondParagraph') }}
                 </p>
            </div>

        </div>
    </v-container>
</template>

<script setup>
import {Head} from '@inertiajs/vue3';
import { __ } from 'matice';
import TheMovieDetailCard from '../Components/TheMovieDetailCard.vue';
import TheExpansionPanel from '../Components/TheExpansionPanel.vue';
import SlideBanner from '../Components/SlideBanner.vue';

const items = [
    {
        title: __('home'),
        disabled: false,
        href: route('index'),
    },
    {
        title: __('aboutPage.title'),
        disabled: true,
        href: route('about'),
    },
]
</script>


<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

.font-cus{
    font-family: 'Kantumruy Pro';
}

</style>
