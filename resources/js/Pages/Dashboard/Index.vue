<template>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-md-4">
                <div id="chart-tickets-sold" class="border p-2 rounded-3"></div>
            </div>
            <div class="col-12 col-md-4">
                <div id="chart-revenue" class="border p-2 rounded-3"></div>
            </div>
            <div class="col-12 col-md-4">
                <div id="chart-occupancy" class="border p-2 rounded-3"></div>
            </div>
        </div>

        <div class="row !mt-[23px]">
            <div class="col-12 col-md-6">
                <div id="chart-line" class="border p-3 rounded-3"></div>
            </div>
            <div class="col-12 col-md-6">
                <div id="chart-pie" class="border p-3 rounded-3"></div>
            </div>
        </div>

        <apexchart width="500" type="bar" :options="barChartOptions" :series="barChartSeries"></apexchart>
    </div>
</template>

<script setup>
    import { onMounted, ref } from 'vue';
    import ApexCharts from 'apexcharts';

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

    const randomizeArray = (arr) => arr.map(() => Math.floor(Math.random() * 100));
    const sparklineData = Array.from({ length: 10 }, () => Math.floor(Math.random() * 100));

onMounted(() => {
    const createSparkline = (selector, value, label) => {
        const options = {
            series: [
                {
                    data: randomizeArray(sparklineData),
                    name: label,
                },
            ],
            chart: { type: 'area', height: 140, sparkline: { enabled: true } },
            stroke: { curve: 'straight' },
            fill: { opacity: 0.3 },
            yaxis: { min: 0 },
            colors: ['#DCE6EC'],
            title: {
                text: value,
                offsetX: 0,
                style: {
                    fontSize: '24px',
                    color: '#44678c'
                }
            },
            subtitle: {
                text: label,
                offsetX: 0,
                style: { fontSize: '14px' }
            }
        };
        new ApexCharts(document.querySelector(selector), options).render();
    };

    createSparkline("#chart-tickets-sold", "8,452", "Tickets Sold");
    createSparkline("#chart-revenue", "$28,600", "Total Revenue");
    createSparkline("#chart-occupancy", "78%", "Occupancy Rate");

    //Line Chart
    const lineChartOptions = {
        series: [
            {
                name: "Regular",
                data: [150, 180, 210, 250, 220, 270, 300, 280, 350],
            },
            {
                name: "VIP",
                data: [30, 40, 50, 70, 60, 80, 100, 90, 120],
            },
            {
                name: "Gold",
                data: [10, 15, 25, 30, 40, 50, 60, 45, 70],
            }
        ],
        chart: {
            height: 300,
            type: "line",
            zoom: { enabled: false },
        },
        title: {
            text: "Monthly Seat Type Bookings",
            style: {
                fontSize: "24px",
                color: "oklch(0.446 0.043 257.281)",
            },
        },
        dataLabels: { enabled: false },
        stroke: { curve: "smooth" },
        grid: { row: { colors: ["#f3f3f3", "transparent"], opacity: 0.5 } },
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep"],
        },
        colors: ["#1E88E5", "#FF4081", "#FFC107"],
    };

    new ApexCharts(document.querySelector("#chart-line"), lineChartOptions).render();


    //Pie Chart
    const pieChartOptions = {
        series: [32, 26, 18, 15, 9],
        chart: {
            type: "pie",
            height: 300,
        },
        labels: ["Action", "Comedy", "Drama", "Horror", "Romance"],
        colors: ["oklch(0.488 0.243 264.376)", "oklch(0.558 0.288 302.321)", "oklch(0.645 0.246 16.439)", "oklch(0.75 0.183 55.934)", "oklch(0.765 0.177 163.223)"],
        title: {
            text: "Ticket Sales by Genre",
            style: {
                fontSize: "24px",
                color: "oklch(0.446 0.043 257.281)",
            },
        },
    };

    new ApexCharts(document.querySelector("#chart-pie"), pieChartOptions).render();
});
</script>
