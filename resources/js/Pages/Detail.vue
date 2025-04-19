<template>
    <v-container fluid>

        <!-- <Head title="Movie Detail Page" /> -->
        <v-row class="mb-10">
            <TheMovieDetailCard v-if="movie" :movie="movie" />
        </v-row>

        <v-row>
            <v-sheet color="transparent" width="100%" rounded="lg">
                <v-tabs v-model="tab" :items="tabs" align-tabs="center" height="60">
                    <template v-slot:tab="{ item }">
                        <v-tab :text="item.text" :value="item.value"
                            class="fs-6 font-bold text-white transition-opacity" :class="{
                                'opacity-100': tab === item.value,
                                'opacity-65 hover:opacity-100 focus:opacity-100': tab !== item.value
                            }" />
                    </template>
                    <template v-slot:item="{ item }">
                        <v-container>
                            <v-tabs-window-item :value="item.value">
                                <div v-if="item.value === 'tab-show'">
                                    <h3 class="text-white fs-1 mt-6 mb-0 pt-10 pb-6 showtime">Showtime</h3>
                                    <TheSelectHallType />
                                    <div class="d-flex gap-4 overflow-x-auto no-scrollbar mt-[60px] mb-11">
                                        <DateButton v-for="(date, index) in showDates" :key="index" :date="date"
                                            :isActive="selectedIndex === index" @click="selectedIndex = index"
                                            class="!w-[170px]" />
                                    </div>

                                    <TheExpansionPanel v-if="showDates.length > 0" :shows="shows"
                                        :selectedDate="showDates[selectedIndex]" />
                                </div>

                                <div v-else-if="item.value === 'tab-detail'" class="pa-4 text-white">
                                    <h3>Synopsis</h3>
                                    <p>{{ movie.description }}</p>
                                </div>
                            </v-tabs-window-item>
                        </v-container>
                    </template>
                </v-tabs>
            </v-sheet>
        </v-row>
    </v-container>
</template>

<script setup>
    import { ref, shallowRef } from 'vue'

    import TheMovieDetailCard from '../Components/TheMovieDetailCard.vue'
    import TheExpansionPanel from '../Components/TheExpansionPanel.vue'
    import TheSelectHallType from '../Components/TheFilterSelectHallType.vue'
    import DateButton from '../Components/DateButton.vue';

    const props = defineProps({
        movie: {
            type: Object,
            required: true
        },
        shows: {
            type: Array,
            required: true
        },
        showDates: {
            type: Array,
            required: true
        },
    })

    const selectedIndex = ref(0)

    const tab = shallowRef('tab-show')
    const tabs = [
        { text: 'Showtime', value: 'tab-show' },
        { text: 'Detail', value: 'tab-detail' }
    ]
</script>

<style scoped>
    .showtime {
        position: relative !important;
        overflow: hidden;

    }

    .showtime::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 1px;
        background: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0));
    }
</style>
