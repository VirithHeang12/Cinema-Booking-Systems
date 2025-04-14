<template>
    <div class="date-card" :class="{ 'date-card--active': isActive }">
        <div class="date-label">{{ dayOfWeek }}</div>
        <div class="date-number">{{ dayNumber }}</div>
        <div class="date-month">{{ monthAbbr }}</div>
    </div>
</template>

<script setup>
    import { computed } from 'vue';

    const props = defineProps({
        date: {
            type: String,
            required: true,
        },
        isActive: {
            type: Boolean,
            default: false
        }
    });

    const dateObj = computed(() => new Date(props.date));

    const dayOfWeek = computed(() => {
        const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        return days[dateObj.value.getDay()];
    });

    const dayNumber = computed(() => dateObj.value.getDate());

    const monthAbbr = computed(() => {
        return dateObj.value.toLocaleString('en-US', { month: 'short' });
    });
</script>

<style scoped>
    .date-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        background-color: #1E1E1E;
        color: white;
        border: 2px solid transparent;
        transition: border-color 0.2s ease-in-out;
    }

    .date-card:hover {
        border-color: rgba(255, 255, 255, 0.9);
    }

    .date-card--active {
        border-color: #FF0000;
    }

    .date-card--active:hover {
        border-color: #FF0000;
    }

    .date-label {
        font-size: 14px;
        margin-bottom: 4px;
    }

    .date-number {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 2px;
    }

    .date-month {
        font-size: 14px;
    }
</style>
