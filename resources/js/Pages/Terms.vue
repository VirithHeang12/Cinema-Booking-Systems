<template>
    <v-container>
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
                <v-col cols="12" md="6" lg="8">
                    <h1 class="font-bold text-gray-300">
                        {{ __("terms.title") }}
                    </h1>
                    <p class="m-0 text-grey text-md ">
                        {{ __("terms.subtitle") }}
                    </p>
                </v-col>
            </v-row>
        </section>

        <section>
            <div v-for="term in terms" :key="term.id">
                <p class="mb-0 text-grey text-md">{{ term.description }}</p>
            </div>
        </section>

        <section class="mt-4">
            <div v-for="change in changes" :key="change.id">
                <p class="mb-0 text-grey text-md">
                    {{ change.description }}
                </p>
            </div>
        </section>

        <section></section>
    </v-container>
</template>

<script setup>
    import { __ } from "matice";
    import BreadcrumbIcon from "../Components/icons/BreadcrumbIcon.vue";

    const currentYear = new Date().getFullYear();

    const items = [
        {
            title: __("home"),
            disabled: false,
            href: route("index"),
        },
        {
            title: __("terms.title"),
            disabled: true,
            href: route("terms"),
        },
    ];

    const terms = [
        {
            id: 1,
            description: __("terms.firstParagraph"),
        },
        {
            id: 2,
            description: __("terms.secondParagraph"),
        },
        {
            id: 3,
            description: __("terms.thirdParagraph"),
        },
        {
            id: 4,
            description: __("terms.fourthParagraph"),
        },
        {
            id: 5,
            description: __("terms.fourthParagraph"),
        },
        {
            id: 6,
            description: __("terms.fifthParagraph"),
        },
    ];

    const changes = [
        {
            id: 1,
            description: __("terms.changed.first"),
        },
        {
            id: 2,
            description: __("terms.changed.second") + " " + currentYear,
        },
    ];
</script>
