<template>
    <v-container class="px-0">
        <v-expansion-panels v-model="panelOpen" class="overflow-hidden rounded-[20px] !border-none">
            <v-expansion-panel v-for="(show) in filteredShows" :key="show.id"
                class="overflow-hidden border-none !outline-none !bg-transparent">
                <v-expansion-panel-title class="bg-black rounded-[20px] font-bold">
                    <div class="flex items-center justify-between w-full">
                        <div class="text-[20px] font-bold">{{ show.hall?.name ?? 'Unknown Hall' }}</div>
                    </div>
                </v-expansion-panel-title>
                <v-expansion-panel-text
                    class="bg-gradient-to-b from-[#400000] to-[#1a0000] text-white rounded-bl-[20px] rounded-br-[20px]">
                    <h4
                        class="text-[35px] font-bold bg-gradient-to-r from-blue-600 to-blue-200 bg-clip-text text-transparent inline-block">
                        {{ show.screen_type?.name ?? '2D' }}
                    </h4>
                    <div class="d-flex align-center mt-2">
                        <div class="language d-flex align-center">
                            <v-icon size="30">mdi-subtitles</v-icon>
                            <div class="ml-2">
                                {{ show.movie_subtitle?.language?.code ?? 'N/A' }}
                            </div>
                            <div class="ml-4"> | </div>
                        </div>
                        <div class="ml-4 flex items-center text-[20px] font-bold">
                            {{ show.hall?.hall_type?.name ?? 'REGULAR HALL' }}
                        </div>
                    </div>
                    <div class="mt-4">
                        <v-btn class="showtime-btn mt-3 text-[20px]" @click="bookCallback(show)">
                            {{ formatTime(show.show_time) }}
                        </v-btn>
                    </div>
                </v-expansion-panel-text>
            </v-expansion-panel>
        </v-expansion-panels>
    </v-container>
</template>

<script setup>
    import { ref, computed } from 'vue';
    import { router } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';

    const props = defineProps({
        selectedDate: {
            type: String,
            required: true,
        },
        shows: {
            type: Array,
            required: true,
        },
    })

    const panelOpen = ref(0)

    const filteredShows = computed(() => {
        return props.shows.filter((show) => {
            const showDate = new Date(show.show_time).toISOString().split('T')[0]
            const selected = new Date(props.selectedDate).toISOString().split('T')[0]
            return showDate === selected
        })
    })

    const formatTime = (datetime) => {
        const date = new Date(datetime)
        return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
    }

    /**
     * Book callback function
     *
     * @param {Object} show
     *
     * @returns {void}
     */
    const bookCallback = (show) => {
        router.visit(route('shows.booking.show', {
            show: show.id,
        }), {
            method: 'get',
            preserveState: true,
            preserveScroll: true,
        })
    }
</script>

<style scoped>
    .showtime-btn {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border-radius: 20px;
        padding: 10px 16px;
        font-weight: bold;
    }
</style>
