<template>
    <footer class="bg-[#242424] px-4 relative overflow-y-hidden bg-blur z-1">
        <v-container class="text-white pb-2">
            <div class="row border-b-[1.8px] border-white/[28%] z-10">
                <div class="col-12 d-flex flex-col justify-center align-center">
                    <img src="/public/logo/sample_logo.png" alt="" class="h-[56px]">
                    <h4 class="opacity-80">Eternal Cineplex</h4>

                    <span class="text-center text-sm font-light opacity-60 leading-5">
                        Your ultimate destination for movies and magic. <br>
                        Discover the latest blockbusters, reserve your seats, and experience <br>unforgettable moments on the big screen — all from the comfort of your home.
                    </span>
                </div>
                <div class="col-12 flex flex-wrap justify-center align-center gap-x-20 gap-y-4 py-6">
                    <a href="#" class="text-white text-decoration-none font-medium transition opacity-65 hover:opacity-100">Terms & Conditions</a>
                    <a href="#" class="text-white text-decoration-none font-medium transition opacity-65 hover:opacity-100">Privacy policy</a>
                    <Link href="/about" class="text-white text-decoration-none font-medium transition opacity-65 hover:opacity-100">About us</Link>
                    <a href="#" class="text-white text-decoration-none font-medium transition opacity-65 hover:opacity-100">Contact us</a>
                    <Link href="/locations" class="text-white text-decoration-none font-medium transition opacity-65 hover:opacity-100">Locations</Link>
                </div>
            </div>

            <div class="row py-1 mt-2 z-10">
                <div class="col-12 px-0 gap-y-4 d-flex flex-wrap justify-content-center justify-content-sm-between">
                    <div class="col-12 col-sm-6 text-center text-sm-left">
                        <span class="opacity-65 text-sm">© 2025 Eternal Cineplex. All rights reserved.</span>
                    </div>
                    <div class="col-12 col-sm-6 flex justify-content-center justify-content-sm-end gap-4">
                        <a href="https://www.facebook.com/" class="opacity-65 text-white hover:opacity-100 transition">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/" class="opacity-65 text-white hover:opacity-100 transition">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://x.com/" class="opacity-65 text-white hover:opacity-100 transition">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                        <a href="https://telegram.org/" class="opacity-65 text-white hover:opacity-100 transition">
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
