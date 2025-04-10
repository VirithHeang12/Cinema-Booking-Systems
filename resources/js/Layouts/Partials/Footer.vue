<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';

</script>

<template>
    <footer class="bg-[#242424] px-4 relative overflow-y-hidden bg-blur z-1 pb-[70px] pb-sm-0">
        <v-container class="pb-2 text-white">
            <div class="row border-b-[1.8px] border-white/[28%] z-10">
                <div class="flex-col justify-center col-12 d-flex align-center">
                    <img src="/public/logo/sample_logo.png" alt="" class="h-[56px]">
                    <h4 class="opacity-80">Eternal Cineplex</h4>

                    <span class="text-sm font-light leading-5 text-center opacity-60">
                        Your ultimate destination for movies and magic. <br>
                        Discover the latest blockbusters, reserve your seats, and experience <br>unforgettable moments
                        on the big screen — all from the comfort of your home.
                    </span>
                </div>
                <div class="flex flex-wrap justify-center py-6 col-12 align-center gap-x-20 gap-y-4">
                    <a href="/terms"
                        class="font-medium text-white transition text-decoration-none opacity-65 hover:opacity-100">Terms
                        & Conditions</a>
                    <Link href="/privacy"
                        class="font-medium text-white transition text-decoration-none opacity-65 hover:opacity-100">
                    Privacy & Policy</Link>
                    <Link href="/about"
                        class="font-medium text-white transition text-decoration-none opacity-65 hover:opacity-100">
                    About us</Link>
                    <Link href="/contact"
                        class="font-medium text-white transition text-decoration-none opacity-65 hover:opacity-100">
                    Contact us</Link>
                </div>
            </div>

            <div class="z-10 py-1 mt-2 row">
                <div class="flex-wrap px-0 col-12 gap-y-4 d-flex justify-content-center justify-content-sm-between">
                    <div class="text-center col-12 col-sm-6 text-sm-left">
                        <span class="text-sm opacity-65">© 2025 Eternal Cineplex. All rights reserved.</span>
                    </div>
                    <div class="flex gap-4 col-12 col-sm-6 justify-content-center justify-content-sm-end">
                        <a href="https://www.facebook.com/" class="text-white transition opacity-65 hover:opacity-100">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/" class="text-white transition opacity-65 hover:opacity-100">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://x.com/" class="text-white transition opacity-65 hover:opacity-100">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                        <a href="https://telegram.org/" class="text-white transition opacity-65 hover:opacity-100">
                            <i class="bi bi-telegram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </v-container>
    </footer>
</template>

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
</style>
