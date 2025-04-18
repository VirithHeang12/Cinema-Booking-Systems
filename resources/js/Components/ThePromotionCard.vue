<template>
    <v-row class="g-4 mt-0">
        <v-col v-for="(promotion, index) in promotions" :key="index" cols="12" sm="6" md="4" lg="4" xl="3">
            <a class="card h-100 p-3 text-decoration-none !rounded-[14px] bg-transparent border" style="border-color: grey !important;">
                <img v-if="promotion.image_url" class="rounded-[10px] object-cover h-[200px]" :src="promotion.image_url"
                    style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" />
                <div class="mt-3">
                    <h5 class="font-semibold text-grey text-clamp !text-[18px]">{{ promotion.description }}</h5>
                </div>
            </a>
        </v-col>
    </v-row>

</template>

<script setup>

 const props = defineProps({
        promotions: {
            type: Array,
            default: () => [],
        },
    });
</script>

<style>
.text-clamp {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
    -webkit-line-clamp: 2;
    text-overflow: ellipsis;
    max-height: calc(1.5em * 2);
    line-height: 1.5em;
}
</style>
