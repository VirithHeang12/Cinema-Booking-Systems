<template>
    <v-col cols="12" sm="6" md="3">
        <Link href="/" class="relative">
        <div class="flex flex-col items-center justify-center">
            <img src="https://i0.wp.com/teaser-trailer.com/wp-content/uploads/2025/01/How-to-Train-Your-Dragon-Movie-2025-Poster.jpg?ssl=1" alt="" class="img-fluid object-cover !w-[250px] !h-[370px] rounded-[15px]" />
            <div class="absolute top-3 right-6">
                <span class="classification inline-flex items-center me-1 px-3 py-1 text-xs font-medium text-gray-200 ring-1 ring-gray-500/10 ring-inset">
                    NC15
                </span>
            </div>
            <div class="mt-2">
                <div class="d-flex align-center my-1">
                    <p class="text-md font-medium mb-0 text-gray-600">03 Jun 2025</p>

                </div>
                <div class="w-[250px] text-wrap overflow-hidden">
                    <h5 class="title font-medium text-zinc-700 hover:text-zinc-800 duration-200 ease-in-out line-clamp-2">
                        How to Train Your Dragon
                    </h5>
                </div>

            </div>

        </div>
        </Link>
    </v-col>
</template>

<script setup>
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
