<template>
    <v-col cols="12" sm="6" md="4" lg="4" xl="3">
        <a href="#" class="card h-100 p-3 shadow-sm text-decoration-none !rounded-[13px]">
            <img class="rounded-[10px] object-cover h-100" :src="proSrc" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            <div class="mt-3">
                <h5 class="font-semibold text-zinc-700 text-clamp !text-[18px]">{{ title }}</h5>
            </div>
        </a>
    </v-col>
</template>

<script setup>
defineProps(['proSrc', 'title']);
</script>

<style>
.text-clamp {
  display: -webkit-box; /* Enable block formatting for webkit-based browsers */
  -webkit-box-orient: vertical; /* Set vertical orientation */
  overflow: hidden; /* Hide overflowing text */
  -webkit-line-clamp: 2; /* Limit text to 2 lines */
  text-overflow: ellipsis; /* Show "..." for clipped text */
  max-height: calc(1.5em * 2); /* Adjust based on line-height and number of lines */
  line-height: 1.5em; /* Adjust for your Bootstrap typography */
}
</style>