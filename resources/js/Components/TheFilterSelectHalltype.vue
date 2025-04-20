<template>
    <v-menu v-model="menu" :close-on-content-click="false" transition="scale-transition" offset-y location="bottom"
        scroll-strategy="none" class="z-1">
        <template #activator="{ props }">
            <v-btn append-icon="mdi-chevron-down" width="100%" v-bind="props" variant="outlined" color="white"
                class="w-100 d-flex justify-space-between py-7 my-5">
                {{ selectedHalltype?.name || 'All Halltypes' }}
            </v-btn>
        </template>

        <v-list class="bg-black text-white my-2 z-10" max-height="240">
            <v-list-item v-for="(hall_type, index) in computedHallTypes" :key="index"
                @click="selectHalltype(hall_type)">
                <template #prepend>
                    <v-icon color="red">mdi-theater</v-icon>
                </template>
                <v-list-item-title class="opacity-85 hover:opacity-100" :class="{ 'text-red': isSelected(hall_type) }">
                    {{ hall_type.name }}
                </v-list-item-title>
            </v-list-item>
        </v-list>
    </v-menu>
</template>
<script setup>
    import { ref, onMounted, watch, computed } from 'vue'
    import axios from 'axios'

    const menu = ref(false)
    const selectedHalltype = ref({ name: 'All Halltypes' });
    const hall_types = ref([]);

    const emit = defineEmits(['update:hallType'])
    onMounted(async () => {
        try {
            const res = await axios.get('/api/v1/dashboard/hall_types')
            hall_types.value = res.data;
        } catch (e) {
            console.error('Failed to load hall types', e)
        }
    })

    const computedHallTypes = computed(() => {
        return [{ name: 'All Hall Types' }, ...hall_types.value]
    })

    function selectHalltype(hall_type) {
        selectedHalltype.value = hall_type
        menu.value = false
    }
    function isSelected(hall_type) {
        return selectedHalltype.value?.name === hall_type.name
    }


    /**
     * Watch for changes in selectedHalltype and emit the update event
     *
     */
    watch(selectedHalltype, (newValue) => {
        emit('update:hallType', newValue)
    })
</script>
