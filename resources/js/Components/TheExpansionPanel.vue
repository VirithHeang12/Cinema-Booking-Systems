<template>
    <v-container class="px-0">
      <v-expansion-panels v-model="panelOpen" class="overflow-hidden rounded-[20px]">
        <v-expansion-panel class="overflow-hidden">
          <v-expansion-panel-title class="bg-black font-bold rounded-[20px] overflow-hidden">
            <div class="flex items-center justify-between w-full">
              <div class="text-[20px] font-bold">Legend Eden Garden</div>
            </div>
          </v-expansion-panel-title>
          <v-expansion-panel-text class="bg-gradient-to-b from-[#400000] to-[#1a0000] text-white rounded-bl-[20px] rounded-br-[20px]">
            <h4 class="text-[50px] font-bold bg-gradient-to-r from-blue-600 to-blue-200 bg-clip-text text-transparent inline-block">2D</h4>
            <div class="d-flex align-center">
              <div class="language d-flex align-center">
                <v-icon size="30">mdi-subtitles</v-icon>
                 <div class="ml-2">ENG</div> 
                 <div class="ml-4"> | </div>
              </div>
              <div class="ml-4 flex items-center text-[20px] font-bold">REGULAR HALL</div>
            </div>
           <div class="mt-4">
            <v-btn class="showtime-btn mt-3 text-[20px]">01:00 PM</v-btn>
           </div>
          </v-expansion-panel-text>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-container>
  </template>
  
  <script setup>
  import { ref } from "vue";

  const panelOpen = ref([0])
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
  