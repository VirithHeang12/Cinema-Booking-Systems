<template>
    <v-container fluid>
        <v-row class="justify-center">
            <v-col cols="12" md="8">
                <div class="bg-white/10 rounded-3 px-5 py-4">
                    <h2 class="text-xl font-bold text-zinc-200">My Bookings</h2>
                    <div class="mt-4">
                        <BookingTicket v-for="(booking, index) in bookings" :key="index" :booking="booking" />
                    </div>
                </div>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup>
    import BookingTicket from '@/Components/BookingTicket.vue';

    const props = defineProps({
        bookings: {
            type: Object,
            required: true,
        }
    })

</script>
