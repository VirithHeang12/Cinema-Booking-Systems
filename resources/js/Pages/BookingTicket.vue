<template>
    <v-container class="my-[20px]">
        <section>
            <v-row class="mb-3">
                <v-col cols="12" md="6" lg="8">
                    <h1 class="font-bold text-zinc-100">{{ __("booking.title") }}</h1>
                    <p class="m-0 text-md text-zinc-100">
                        {{ __("booking.subtitle") }}
                    </p>
                </v-col>
            </v-row>

            <div class="row">
                <div class="col-12 col-md-8 mb-3">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div v-for="row in seats" :key="row.label" class="seat-row">
                                <span class="row-label">{{ row.label }}</span>

                                <div class="flex-grow flex justify-center">
                                    <Seat v-for="seat in row.seats" :key="seat.id" :seat-id="seat.id"
                                        :seat-number="seat.number" :status="seat.status"
                                        @select="() => toggleSeat(seat.id)" />
                                </div>

                                <span class="row-label">{{ row.label }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <img :src="movie.thumbnail_url" :alt="movie.title"
                                class="!h-[200px] !w-full object-fit-cover mb-3 rounded-3" />

                            <h5 class="card-title">Movie: {{ movie.title }}</h5>
                            <h5 class="card-title">Time: {{ show.show_time }}</h5>
                            <h5 class="card-title">Date: {{ show.show_time }}</h5>
                            <h5 class="card-title">Hall: {{ show.hall.name }}</h5>

                            <h6 class="card-subtitle mb-2 text-body-secondary">
                                {{ totalAmount }}
                            </h6>
                            <p class="card-text">
                                Some quick example text to build on the card title and make up
                                the bulk of the card's content.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </v-container>
</template>

<script setup>
    import { computed, ref } from "vue";
    import { __ } from "matice";
    import Seat from "../Components/Seat.vue";

    const props = defineProps({
        movie: {
            type: Object,
            required: true,
        },
        show: {
            type: Object,
            required: true,
        },
        seatRows: {
            type: Array,
            required: true,
        },
    });

    const selectedSeatIds = ref([]);

    const seats = computed(() => {
        return props.seatRows.map((row) => {
            return {
                label: row.label,
                seats: row.seats.map((seat) => {
                    return {
                        ...seat,
                        status: selectedSeatIds.value.includes(seat.id)
                            ? "selected"
                            : seat.status,
                    };
                }),
            }
        });
    });

    const totalAmount = computed(() => {
        return selectedSeatIds.value.reduce((total, seatId) => {
            const seat = props.seatRows.flatMap(row => row.seats).find(seat => seat.id === seatId);
            return total + (seat ? seat.price : 0);
        }, 0);
    });

    /**
     * Toggle the seat status between available and selected
     *
     * @param seatId
     *
     * @returns {void}
     */
    function toggleSeat(seatId) {
        if (selectedSeatIds.value.includes(seatId)) {
            selectedSeatIds.value = selectedSeatIds.value.filter(id => id !== seatId);
        } else {
            selectedSeatIds.value.push(seatId);
        }
    }

</script>

<style scoped>
    .booking-page {
        padding: 20px;
    }

    .seat-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .row-label {
        color: #494141;
        width: 30px;
        font-weight: bold;
        margin-right: 10px;
        text-align: center;
    }

    .selected-info {
        margin-top: 20px;
        background: #f7f7f7;
        padding: 10px;
        border-radius: 6px;
    }
</style>
