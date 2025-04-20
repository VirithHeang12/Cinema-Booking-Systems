<template>
    <v-container class="my-[20px]">
        <div class="row">
            <div class="col-12">
                <img src="/public/image/promotion.png" alt=""
                    class="img-fluid object-cover w-100 !h-[500px] rounded-[15px]" />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <v-breadcrumbs :items="items" class="px-0 mb-0 text-[17px] text-gray-300">
                    <template v-slot:divider>
                        <BreadcrumbIcon />
                    </template>
                </v-breadcrumbs>
            </div>
        </div>

        <section>
            <v-row class="mb-3">
                <v-col>
                    <h1 class="font-bold text-gray-300">{{ __('promotions.title') }}</h1>
                </v-col>
            </v-row>

            <ThePromotionCard :promotions="banners" />
        </section>
    </v-container>
</template>

<script setup>
    import { __ } from "matice";
    import BreadcrumbIcon from "../Components/icons/BreadcrumbIcon.vue";
    import ThePromotionCard from "../Components/ThePromotionCard.vue";



    const props = defineProps({
        banners: {
            type: Array,
            default: () => [],
        },
    });

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


</script>

<style>
    .v-breadcrumbs-divider {
        padding: 0 !important;
    }
</style>
