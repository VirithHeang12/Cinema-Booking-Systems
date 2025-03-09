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

        <div class="col-12 col-md-6">
                <div class="border p-2 rounded-3">
                    <apexchart
    width="100%"
    height="313"
    type="bar"
    :options="columnChartOptions"
    :series="columnChartSeries">
</apexchart>

                </div>
        </div>
    </div>

</template>

<script setup>
    import { computed } from 'vue';
    import { ref } from 'vue';

    const props = defineProps({
        moviesByYear: Array
    });

const barChartOptions = ref({
    chart: {
        type: 'bar',
    },
    xaxis: {
        type: 'category'
    },
});

    const barChartSeries = computed(() => {
        return [
            {
                name: 'Series 1',
                data: props.moviesByYear.map((item) => ({
                    x: item.year,
                    y: item.count
                }))
            },
        ]
    });

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
    }
    );

const pieChartSeries = ref([32, 26, 18, 15, 9]);

const colors = ['#FF4560', '#008FFB', '#000000', '#FEB019', '#775DD0', '#546E7A', '#26A69A', '#D10CE8'];

const columnChartOptions = ref({
    chart: {
        type: 'bar',
        height: 350,
    },
    plotOptions: {
        bar: {
            columnWidth: '45%',
            distributed: true,
        },
    },
    colors: colors,
    dataLabels: {
        enabled: true,
    },
    legend: {
        show: true,
    },
    title: {
        text: 'Movies per Genre',
        style: {
            fontSize: '18px',
            color: "oklch(0.446 0.043 257.281)",
        }
    },
});

const columnChartSeries = ref([
    {
        name: 'Number of Movies',
        data: [
            { x: 'Action', y: 120 },
            { x: 'Adventure', y: 95 },
            { x: 'Drama', y: 160 },
            { x: 'Fantasy', y: 80 },
            { x: 'Horror', y: 60 },
            { x: 'Mystery', y: 70 },
            { x: 'Romance', y: 110 },
            { x: 'Sci-Fi', y: 90 },
            { x: 'Thriller', y: 100 },
        ],

    },
]);
</script>
