<template>
    <div>
        <ul>
            <li v-for="([, value], i) in Object.entries(props.languages)" :key="i">
                <a :href="value.path">
                    {{ value.native }}
                </a>
            </li>
        </ul>

        <h1>{{ $trans('welcome') }}</h1>
        <v-btn @click="clickCallback('about')">About</v-btn>
        <v-btn @click="clickCallback('contact')">Contact</v-btn>


    </div>
</template>

<script setup>
    import { Link, router, usePage } from '@inertiajs/vue3'
    import { route } from 'ziggy-js';

    const { props } = usePage();

    const clickCallback = (r) => {
        router.get(route(r));
    }
</script>
