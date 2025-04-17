<template>
    <v-container class="px-0">
        <v-expansion-panels v-model="panelOpen" class="overflow-hidden rounded-[20px] !border-none">
            <v-expansion-panel v-for="(show, index) in filteredShows" :key="show.id" class="overflow-hidden border-none !outline-none">
                <v-expansion-panel-title class="bg-black font-bold rounded-[20px] overflow-hidden">
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
                        <v-btn class="showtime-btn mt-3 text-[20px]">
                            {{ formatTime(show.show_time) }}
                        </v-btn>
                    </div>
                </v-expansion-panel-text>
            </v-expansion-panel>
        </v-expansion-panels>
    </v-container>
</template>

<script setup>
import { ref, onMounted, watch, computed} from 'vue'
import axios from 'axios'

const props = defineProps({
    movieId: {
        type: [Number, String],
        required: true
    },
    selectedDate: {
    type: String,
    required: true
  }
})
const shows = ref([])
const panelOpen = ref(0)

watch(
    () => props.movieId,
    async (newVal) => {
        if (newVal) {
            await fetchShows()
        } else {
            console.warn('movieId is undefined, cannot fetch shows yet.')
        }
    },
    { immediate: true }
)

const filteredShows = computed(() => {
  return shows.value.filter(show => {
    const showDate = new Date(show.show_time).toISOString().split('T')[0]
    const selected = new Date(props.selectedDate).toISOString().split('T')[0]
    return showDate === selected
  })
})


const fetchShows = async () => {
    try {
        const response = await axios.get(`/api/v1/dashboard/movies/${props.movieId}/shows`)
        shows.value = response.data
    } catch (error) {
        console.error('Failed to fetch show data:', error)
    }
}

const formatTime = (datetime) => {
    const date = new Date(datetime)
    return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
}

onMounted(() => {
    fetchShows()
})
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
