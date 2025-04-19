<template>
    <v-container>
        <v-row class="justify-center">
            <v-col>
                <div class="bg-white/10 rounded-3 px-5 py-4">
                    <h2 class="text-xl font-bold text-zinc-200">My Bookings</h2>
                    <v-row class="mt-4" dense>
                        <v-col v-for="(booking, index) in bookings" :key="index" cols="12" md="6">
                            <BookingTicket :booking="booking" />
                        </v-col>
                    </v-row>
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
