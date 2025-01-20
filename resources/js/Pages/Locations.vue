<template>
    <v-container class="my-[20px]">
        <div class="row">
            <div class="col-12">
                <img src="/public/image/location_banner.png" alt="" class="img-fluid object-cover w-100 !h-[400px] rounded-[15px]" />
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
                <v-col cols="12" md="6" lg="8">
                    <h1 class="font-bold text-gray-800">{{ __('locations.title') }}</h1>
                    <p class="m-0 text-md text-gray-700">{{ __('locations.subtitle') }}</p>
                </v-col>
                <v-col cols="12" md="6" lg="4" class="place-self-center place-items-end">
                    <v-text-field class="w-full lg:w-9/12" :placeholder="__('locations.searchPlaceholder')" color="#9e9e9e" hide-details append-inner-icon="mdi-magnify" density="compact" variant="outlined">
                    </v-text-field>
                </v-col>
            </v-row>

            <v-row class="g-4 mt-0">
                <TheLocationCard v-for="location in locations" :key="location.id" :mapSrc="location.mapSrc" :title="location.title" :address="location.address" :view_showtimes="__('locations.view_showtimes')" />
            </v-row>
        </section>
    </v-container>
</template>

<script setup>
import { __ } from "matice";
import BreadcrumbIcon from "../Components/icons/BreadcrumbIcon.vue";
import TheLocationCard from "../Components/TheLocationCard.vue";

const items = [
    {
        title: __("home"),
        disabled: false,
        href: route("index"),
    },
    {
        title: __("locations.title"),
        disabled: true,
        href: route("locations"),
    },
];

const locations = [
    {
        id: 1,
        title: "Eden Garden Mall",
        mapSrc: "https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31269.199136535204!2d104.910929!3d11.576937!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951661e6f9d5b%3A0xd2facf408995989e!2sEden%20Garden%20Mall!5e0!3m2!1sen!2skh!4v1737304298391!5m2!1sen!2skh",
        address: "City Center Boulevard, Sangkat Srah Chak"
    },

]
</script>

<style>
.v-breadcrumbs-divider {
    padding: 0 !important;
}
</style>
