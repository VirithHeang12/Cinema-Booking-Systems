<template>
    <!-- <TheMovieDetailCard v-if="movie" :movie="movie" /> -->
    <v-container>
        <Head title="Movie Detail Page" />
        <v-row class="mb-10" container-fluid>
            <TheMovieDetailCard v-if="movie" :movie="movie" />
        </v-row>
        <v-row>
            <v-sheet color="transparent" width="100%" rounded="lg">
                <v-tabs v-model="tab" :items="tabs" align-tabs="center" height="60">
                    <template v-slot:tab="{ item }">
                        <v-tab :text="item.text" :value="item.value"
                            class="fs-6 font-bold text-[#242424] transition-opacity"
                            :class="{
                            'opacity-100': tab === item.value,
                            'opacity-65 hover:opacity-100 focus:opacity-100': tab !== item.value
                            }"
                        ></v-tab>
                    </template>
                    <template v-slot:item="{ item }">
                        <v-tabs-window-item :value="item.value">
                            <v-divider color="#242424" class="my-9"></v-divider>
                            <div v-if="item.value === 'tab-show'">
                                <h3 class="text-[#242424] fs-1 my-7">Showtime</h3>
                                <TheSelectHalltype />
                                <TheDateButton class="my-5"/>
                                <TheExpansionPanel />
                                <TheExpansionPanel />
                                <TheExpansionPanel />
                                <TheExpansionPanel />
                            </div>
                            <div v-else-if="item.value === 'tab-detail'" class="pa-4">
                                <h3>Synopsis</h3>
                                <p>
                                    {{ movie.description }}
                                </p>
                            </div>
                        </v-tabs-window-item>
                    </template>
                </v-tabs>
            </v-sheet>
        </v-row>
    </v-container>
</template>
  
<script setup>
    import { __ } from 'matice';
    import TheMovieDetailCard from '../Components/TheMovieDetailCard.vue';
    import TheExpansionPanel from '../Components/TheExpansionPanel.vue';
    import TheSelectHalltype from '../Components/TheFilterSelectHalltype.vue';
    import TheDateButton from '../Components/TheDateButton.vue';
    import { ref, onMounted } from 'vue'
    import { usePage } from '@inertiajs/vue3'
    import axios from 'axios'
    import { shallowRef } from 'vue'
    
    const page = usePage()
    const movie = ref(null)
    
    const movieId = page.props.id // passed from Laravel route
    
    onMounted(async () => {
        try {
        const res = await axios.get(`/api/v1/dashboard/movies/${movieId}`)
            movie.value = res.data.data;
        } catch (e) {
            console.error('Failed to load movie', e)
        }
    })

    const tab = shallowRef('tab-show')
    const tabs = [
      {
        text: 'Showtime',
        value: 'tab-show',
      },
      {
        text: 'Detail',
        value: 'tab-detail',
      },
    ]

    // const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    // const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

    // Show 7 days starting from today
    // const dayButtons = ref([])
    // const selectedIndex = ref(0)

    // for (let i = 0; i < 7; i++) {
    // const date = new Date()
    // date.setDate(date.getDate() + i)

    // dayButtons.value.push({
    //     day: i === 0 ? 'Today' : days[date.getDay()],
    //     date: date.getDate(),
    //     month: months[date.getMonth()],
    // })
    // }

</script>