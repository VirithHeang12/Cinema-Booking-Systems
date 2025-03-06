<template>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="border p-2 rounded-3">
                    <apexchart width="100%" height="300" type="line" :options="lineChartOptions"
                        :series="lineChartSeries">
                    </apexchart>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="border p-2 rounded-3">
                    <apexchart width="100%" height="313" type="pie" :options="pieChartOptions" :series="pieChartSeries">
                    </apexchart>
                </div>
            </div>
        </div>

        <apexchart width="500" type="bar" :options="barChartOptions" :series="barChartSeries"></apexchart>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const barChartOptions = ref({
    chart: {
        type: 'bar',
    },
    xaxis: {
        type: 'category'
    },
});

const barChartSeries = ref([
    {
        name: 'Series 1',
        data: [
            {
                x: 'Jan',
                y: 30,
            },
            {
                x: 'Feb',
                y: 40,
            },
            {
                x: 'Mar',
                y: 45,
            },
            {
                x: 'Apr',
                y: 50,
            },
            {
                x: 'May',
                y: 49,
            },
            {
                x: 'Jun',
                y: 60,
            },
            {
                x: 'Jul',
                y: 70,
            },
            {
                x: 'Aug',
                y: 91,
            },
            {
                x: 'Sep',
                y: 125,
            },
        ],
    },
]);



const lineChartOptions = ref({
    chart: {
        type: 'line',
        height: 300,
        zoom: { enabled: false },
    },
    title: {
        text: 'Monthly Seat Type Bookings',
        style: {
            fontSize: '18px',
            color: "oklch(0.446 0.043 257.281)",
        }
    },
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
    },
    colors: ['#1E88E5', '#FF4081', '#FFC107']
});

const lineChartSeries = ref([
    {
        name: 'Regular',
        data: [150, 180, 210, 250, 220, 270, 300, 280, 350]
    },
    {
        name: 'VIP',
        data: [30, 40, 50, 70, 60, 80, 100, 90, 120]
    },
    {
        name: 'Gold',
        data: [10, 15, 25, 30, 40, 50, 60, 45, 70]
    }
]);

const pieChartOptions = ref({
    chart: {
        type: 'pie',
        height: 100
    },
    labels: ['Action', 'Comedy', 'Drama', 'Horror', 'Romance'],
    title: {
        text: 'Ticket Sales by Genre',
        style: {
            fontSize: '18px',
            color: "oklch(0.446 0.043 257.281)",
        }
    }
});
const pieChartSeries = ref([32, 26, 18, 15, 9]);
</script>
