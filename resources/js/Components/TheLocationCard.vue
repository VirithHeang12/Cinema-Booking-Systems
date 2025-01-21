<template>
    <v-col cols="12" sm="6" md="4" lg="3">
        <div class="card p-3 shadow-sm !rounded-[13px]">
            <iframe class="rounded-[10px]" :src="mapSrc" width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="mt-3">
                <h5 class="font-semibold text-zinc-700">{{ title }}</h5>
                <div class="d-flex align-center">
                    <i class="bi bi-geo-alt-fill text-red-800"></i>
                    <p class="text-sm font-medium ps-2 mb-0 text-gray-600">{{ address }}</p>
                </div>
                <Link class="text-sm pt-3 float-end">{{ view_showtimes }}</Link>
            </div>
        </div>
    </v-col>
</template>

<script setup>
defineProps(['mapSrc', 'title', 'address', 'view_showtimes']);
</script>
