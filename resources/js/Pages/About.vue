<template>
    <v-container class="my-[30px]">
        <div class="row">
            <div class="col-12">
                <img src="/public/image/banner_about.jpg" alt="" class="img-fluid w-100 h-[200px] rounded-[25px]" />
            </div>
        </div>
        <div class="row ">
            <div class="col-12">
                <v-breadcrumbs :items="items" class="px-0 mt-[15px] mb-0 text-[17px] text-gray-600">
                    <template v-slot:divider>
                        <svg  class="mt-[5px]" width="30px" height="30px" viewBox="0 0 24 24" fill="none"
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

                <p class="text-gray-600 fw-semibold text-[32px]">About Eternal Cineplex</p>
                <p class="text-gray-600 text-justify mt-[20px] text-[17px]">
                    Welcome to Eternal Cinema, where stories transcend time and the magic of the silver screen comes
                    alive. At Eternal
                    Cinema, we believe movies are more than just entertainment—they’re a portal to new worlds, a
                    celebration of diverse
                    cultures, and a bridge to shared human emotions.

                    Located in the heart of [Your City], Eternal Cinema is designed to provide an unforgettable
                    cinematic experience. <br /> <br />
                    Our state-of-the-art screens, immersive sound systems, and luxurious seating ensure you enjoy every
                    moment in
                    unparalleled comfort. From blockbuster hits to timeless classics and thought-provoking indie films,
                    we curate a
                    diverse lineup of films to cater to all tastes and generations.

                    At Eternal Cinema, we’re not just about movies; we’re about community. Whether you’re here for a
                    family outing, a
                    date night, or to catch a solo flick, we strive to create a welcoming space where everyone feels at
                    home. Our
                    special events, like themed movie nights and director Q&A sessions, make every visit an experience
                    to remember.
                </p>
            </div>

        </div>
    </v-container>
</template>

<script setup>
const items = [
    {
        title: 'Home',
        disabled: false,
        href: route('index'),
    },
    {
        title: 'About Eternal Cineplex',
        disabled: true,
        href: route('about'),
    },
]
</script>
