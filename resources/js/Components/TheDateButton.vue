<template>
    <v-row class="px-4 gap-4 overflow-x-auto flex-nowrap no-scrollbar">
      <v-btn
        v-for="(btn, index) in dayButtons"
        :key="index"
        :class="[
          'transition-all',
          'hover:!border-black',
          selectedIndex === index ? 'border-2 !border-red-500' : '!border-gray-400'
        ]"
        variant="outlined"
        height="100%"
        @click="select(index)"
      >
        <div class="py-4 px-8 px-sm-10 px-md-12 d-flex flex-column gap-0.5 align-center justify-center">
          <p class="text-xs m-0 opacity-65">{{ btn.day }}</p>
          <h3 class="m-0 font-bold">{{ btn.date }}</h3>
          <p class="text-xs m-0 opacity-65">{{ btn.month }}</p>
        </div>
      </v-btn>
    </v-row>
</template>
  
<script setup>
  import { ref } from 'vue'
  
  const emit = defineEmits(['update:selected'])
  
  const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
  const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
  
  const dayButtons = ref([])
  const selectedIndex = ref(0)
  
  for (let i = 0; i < 7; i++) {
    const date = new Date()
    date.setDate(date.getDate() + i)
  
    dayButtons.value.push({
      day: i === 0 ? 'Today' : days[date.getDay()],
      date: date.getDate(),
      month: months[date.getMonth()],
      fullDate: date,
    })
  }
  
  function select(index) {
    selectedIndex.value = index
    emit('update:selected', dayButtons.value[index])
  }
</script>
  
<style scoped>
  .no-scrollbar {
    scrollbar-width: none;
    -ms-overflow-style: none;
  }
  .no-scrollbar::-webkit-scrollbar {
    display: none;
  }
</style>