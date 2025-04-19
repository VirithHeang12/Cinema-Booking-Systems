<template>
    <div class="seat-wrapper" @click="handleClick">
        <img :src="seatImage" :alt="`Seat ${seatNumber}`" class="seat-image"
            :class="{ disabled: status === 'unavailable' }" />
        <span v-if="status === 'available'" class="seat-number">{{ seatNumber }}</span>
    </div>
</template>

<script setup>
    import { computed } from 'vue';

    const props = defineProps({
        seatId: Number,
        seatNumber: Number,
        status: {
            type: String, // 'available', 'unavailable'
            default: 'available',
        },
        seatType: {
            type: String, // 'Regular', 'VIP'
            default: 'Regular'
        }
    })

    const emit = defineEmits(['select'])

    const seatImage = computed(() => {
        const isRegularSeatType = props.seatType == 'Regular'

        switch (props.status) {
            case 'selected':
                return '/image/seats/selected.png'
            case 'unavailable':
                return '/image/seats/unavailable.png'
            default:
                return isRegularSeatType ? '/image/seats/available.png' : '/image/seats/available-gold.png'
        }
    })

    function handleClick() {
        if (props.status !== 'unavailable') {
            emit('select', props.seatId)
        }
    }
</script>

<style scoped>
    .seat-wrapper {
        position: relative;
        width: 40px;
        height: 40px;
        margin: 6px;
        cursor: pointer;
    }

    .seat-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.2s ease;
    }

    .seat-image.disabled {
        cursor: not-allowed;
        opacity: 0.6;
    }

    .seat-number {
        font-family: 'Inter';
        position: absolute;
        top: 50%;
        transform: translate(0, -78%);
        width: 100%;
        text-align: center;
        font-size: 10px;
        color: #d8d8d8;
        font-weight: 600;
    }
</style>
