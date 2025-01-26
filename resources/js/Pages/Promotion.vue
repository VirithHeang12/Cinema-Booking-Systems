<template>
    <v-container class="my-[20px]">
        <div class="row">
            <div class="col-12">
                <img src="/public/image/banner_about.jpg" alt="" class="img-fluid object-cover w-100 !h-[400px] rounded-[15px]" />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <v-breadcrumbs :items="items" class="px-0 mb-0 text-[17px]">
                    <template v-slot:divider>
                        <BreadcrumbIcon />
                    </template>
                </v-breadcrumbs>
            </div>
        </div>

        <section>
            <v-row class="mb-3">
                <v-col>
                    <h1 class="font-bold text-gray-800">{{ __('promotions.title') }}</h1>
                </v-col>
            </v-row>

            <v-row class="g-4 mt-0">
                <ThePromotionCard v-for="promotion in promotions" :key="promotion.id" :proSrc="promotion.proSrc" :title="promotion.title" />
            </v-row>
        </section>
    </v-container>
</template>

<script setup>
import { __ } from "matice";
import BreadcrumbIcon from "../Components/icons/BreadcrumbIcon.vue";
import ThePromotionCard from "../Components/ThePromotionCard.vue";

const items = [
    {
        title: __("home"),
        disabled: false,
        href: route("index"),
    },
    {
        title: __("promotions.title"),
        disabled: true,
        href: route("promotions"),
    },
];

const promotions = [
    {
        id: 1,
        title: "ក្លាយជាសមាជិក Diamond Member  ដើម្បីទទួលបានអត្ថប្រយោជន៏ផ្តាច់មុខនិងសិទ្ធិពិសេសជាច្រើនលើសគេ",
        proSrc: "https://coolbeans.sgp1.digitaloceanspaces.com/legend-cinema-prod/24f5e3a1-3c99-4544-90d5-0f77be765276.jpeg",
    },
    {
        id: 2,
        title: "រឿង Mufasa: <The Lion King> កំពុងចាក់បញ្ចាំងនៅរោងភាពយន្ត Neak Cinema",
        proSrc: "https://coolbeans.sgp1.digitaloceanspaces.com/legend-cinema-prod/6643730d-1ab7-421e-bd2a-dca3715018d3.jpeg",
    },

]
</script>

<style>
.v-breadcrumbs-divider {
    padding: 0 !important;
}
</style>
