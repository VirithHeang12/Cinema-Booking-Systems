<template>
    <div class="card !text-zinc-200">
        <div class="card-body">
            <!-- Movie Thumbnail -->
            <img :src="booking.movie.thumbnail_url" :alt="booking.movie.title"
                class="!h-[200px] !w-full object-fit-cover mb-3 rounded-4" />

            <img :src="booking.qr_code" :alt="booking.movie.title"
                class="!h-[200px] !w-full object-fit-cover mb-3 rounded-4" />

            <!-- Movie Details -->
            <div class="movie-details-container relative space-y-3 my-4 pb-5">
                <div class="flex justify-between items-start gap-4">
                    <span class="font-medium text-gray-300 w-12">Movie</span>
                    <span class="vertical-colon">:</span>
                    <span class="text-md flex-1 text-right">{{
                        booking.movie.title
                        }}</span>
                </div>

                <div class="flex justify-between items-start gap-4">
                    <span class="font-medium text-gray-300 w-12">Date</span>
                    <span class="vertical-colon">:</span>
                    <span class="text-md flex-1 text-right">{{ booking.hall.type }}</span>
                </div>

                <div class="flex justify-between items-start gap-4">
                    <span class="font-medium text-gray-300 w-12">Hall</span>
                    <span class="vertical-colon">:</span>
                    <span class="text-md flex-1 text-right">{{ booking.hall.name }}</span>
                </div>

                <div class="flex justify-between items-start gap-4">
                    <span class="font-medium text-gray-300 w-12">Date</span>
                    <span class="vertical-colon">:</span>
                    <span class="text-md flex-1 text-right">{{ booking.show.date }}</span>
                </div>

                <div class="flex justify-between items-start gap-4">
                    <span class="font-medium text-gray-300 w-12">Time</span>
                    <span class="vertical-colon">:</span>
                    <span class="text-md flex-1 text-right">{{ booking.show.time }}</span>
                </div>
            </div>

            <!-- Selected Seats -->
            <div class="my-4">
                <h6 class="text-md font-bold text-zinc-200">Booked Seats:</h6>
                <div class="flex flex-wrap gap-2 mt-3">
                    <v-chip v-for="label in booking.seats" :key="label" color="white" class="px-3 !font-semibold"
                        variant="tonal" size="small">
                        {{ label }}
                    </v-chip>
                </div>
            </div>

            <div class="bg-white/10 rounded-3 px-5 py-4 flex justify-between items-center">
                <h6 class="text-md font-semibold !mb-0">Total Amount :</h6>
                <span class="text-xl font-bold text-white">$ {{ booking.total_amount }}</span>
            </div>
        </div>
    </div>
</template>

<script setup>
    const props = defineProps({
        booking: {
            type: Object,
            required: true,
        }
    })

    console.log(props.booking)
</script>

<style scoped>
    .card {
        background: rgba(0, 0, 0, 0.3);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(223, 223, 223, 0.2);
    }

    .movie-details-container::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 1px;
        background: linear-gradient(to right,
                rgba(255, 255, 255, 0),
                rgba(255, 255, 255, 0.4),
                rgba(255, 255, 255, 0));
    }

    .movie-details-container::after {
        bottom: 0;
        top: auto;
    }
</style>
