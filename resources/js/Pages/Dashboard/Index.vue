<template>
    <div class="container mt-4">
        <div class="row justify-evenly">
            <div class="col-12 col-md-3 border p-3 rounded-3">
                <div class="d-flex items-center gap-3">
                    <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center">
                        <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.948 1.25H12.052C12.9505 1.24997 13.6997 1.24995 14.2945 1.32991C14.9223 1.41432 15.4891 1.59999 15.9445 2.05546C16.4 2.51093 16.5857 3.07773 16.6701 3.70552C16.7292 4.14512 16.7446 4.66909 16.7486 5.27533C17.3971 5.29614 17.9752 5.33406 18.489 5.40314C19.6614 5.56076 20.6104 5.89288 21.3588 6.64124C22.1071 7.38961 22.4392 8.33856 22.5969 9.51098C22.75 10.6502 22.75 12.1058 22.75 13.9436V14.0564C22.75 15.8942 22.75 17.3498 22.5969 18.489C22.4392 19.6614 22.1071 20.6104 21.3588 21.3588C20.6104 22.1071 19.6614 22.4392 18.489 22.5969C17.3498 22.75 15.8942 22.75 14.0564 22.75H9.94359C8.10583 22.75 6.65019 22.75 5.51098 22.5969C4.33856 22.4392 3.38961 22.1071 2.64124 21.3588C1.89288 20.6104 1.56076 19.6614 1.40314 18.489C1.24997 17.3498 1.24998 15.8942 1.25 14.0564V13.9436C1.24998 12.1058 1.24997 10.6502 1.40314 9.51098C1.56076 8.33856 1.89288 7.38961 2.64124 6.64124C3.38961 5.89288 4.33856 5.56076 5.51098 5.40314C6.02475 5.33406 6.60288 5.29614 7.2514 5.27533C7.2554 4.66909 7.27081 4.14512 7.32991 3.70552C7.41432 3.07773 7.59999 2.51093 8.05546 2.05546C8.51093 1.59999 9.07773 1.41432 9.70552 1.32991C10.3003 1.24995 11.0495 1.24997 11.948 1.25ZM8.7518 5.25178C9.12993 5.24999 9.52694 5.25 9.94358 5.25H14.0564C14.4731 5.25 14.8701 5.24999 15.2482 5.25178C15.244 4.68146 15.23 4.25125 15.1835 3.90539C15.1214 3.44393 15.0142 3.24644 14.8839 3.11612C14.7536 2.9858 14.5561 2.87858 14.0946 2.81654C13.6116 2.7516 12.964 2.75 12 2.75C11.036 2.75 10.3884 2.7516 9.90539 2.81654C9.44393 2.87858 9.24643 2.9858 9.11612 3.11612C8.9858 3.24644 8.87858 3.44393 8.81654 3.90539C8.77004 4.25125 8.75601 4.68146 8.7518 5.25178ZM5.71085 6.88976C4.70476 7.02503 4.12511 7.2787 3.7019 7.70191C3.27869 8.12511 3.02502 8.70476 2.88976 9.71085C2.75159 10.7385 2.75 12.0932 2.75 14C2.75 15.9068 2.75159 17.2615 2.88976 18.2892C3.02502 19.2952 3.27869 19.8749 3.7019 20.2981C4.12511 20.7213 4.70476 20.975 5.71085 21.1102C6.73851 21.2484 8.09318 21.25 10 21.25H14C15.9068 21.25 17.2615 21.2484 18.2892 21.1102C19.2952 20.975 19.8749 20.7213 20.2981 20.2981C20.7213 19.8749 20.975 19.2952 21.1102 18.2892C21.2484 17.2615 21.25 15.9068 21.25 14C21.25 12.0932 21.2484 10.7385 21.1102 9.71085C20.975 8.70476 20.7213 8.12511 20.2981 7.70191C19.8749 7.2787 19.2952 7.02503 18.2892 6.88976C17.2615 6.7516 15.9068 6.75 14 6.75H10C8.09318 6.75 6.73851 6.7516 5.71085 6.88976ZM12 9.25C12.4142 9.25 12.75 9.58579 12.75 10V10.0102C13.8388 10.2845 14.75 11.143 14.75 12.3333C14.75 12.7475 14.4142 13.0833 14 13.0833C13.5858 13.0833 13.25 12.7475 13.25 12.3333C13.25 11.9493 12.8242 11.4167 12 11.4167C11.1758 11.4167 10.75 11.9493 10.75 12.3333C10.75 12.7174 11.1758 13.25 12 13.25C13.3849 13.25 14.75 14.2098 14.75 15.6667C14.75 16.857 13.8388 17.7155 12.75 17.9898V18C12.75 18.4142 12.4142 18.75 12 18.75C11.5858 18.75 11.25 18.4142 11.25 18V17.9898C10.1612 17.7155 9.25 16.857 9.25 15.6667C9.25 15.2525 9.58579 14.9167 10 14.9167C10.4142 14.9167 10.75 15.2525 10.75 15.6667C10.75 16.0507 11.1758 16.5833 12 16.5833C12.8242 16.5833 13.25 16.0507 13.25 15.6667C13.25 15.2826 12.8242 14.75 12 14.75C10.6151 14.75 9.25 13.7903 9.25 12.3333C9.25 11.143 10.1612 10.2845 11.25 10.0102V10C11.25 9.58579 11.5858 9.25 12 9.25Z"
                                    fill="#46608b"></path>
                            </g>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-slate-700 mb-0">
                            ${{ animatedRevenue.toLocaleString() }}
                        </p>
                        <p class="text-slate-500 mb-0 ">Total Booking Revenue</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 border p-3 rounded-3">
                <div class="d-flex items-center gap-3">
                    <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center">
                        <svg width="38px" height="38px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M5 12.0002C5 10.694 4.16519 9.58273 3 9.1709V7.6C3 7.03995 3 6.75992 3.10899 6.54601C3.20487 6.35785 3.35785 6.20487 3.54601 6.10899C3.75992 6 4.03995 6 4.6 6H19.4C19.9601 6 20.2401 6 20.454 6.10899C20.6422 6.20487 20.7951 6.35785 20.891 6.54601C21 6.75992 21 7.03995 21 7.6V9.17071C19.8348 9.58254 19 10.694 19 12.0002C19 13.3064 19.8348 14.4175 21 14.8293V16.4C21 16.9601 21 17.2401 20.891 17.454C20.7951 17.6422 20.6422 17.7951 20.454 17.891C20.2401 18 19.9601 18 19.4 18H4.6C4.03995 18 3.75992 18 3.54601 17.891C3.35785 17.7951 3.20487 17.6422 3.10899 17.454C3 17.2401 3 16.9601 3 16.4V14.8295C4.16519 14.4177 5 13.3064 5 12.0002Z"
                                    stroke="#46608b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-slate-700 mb-0">
                            {{ animatedTicket.toLocaleString() }}
                        </p>
                        <p class="text-slate-500 mb-0 ">Total Booking Tickets</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 border p-3 rounded-3">
                <div class="d-flex items-center gap-3">
                    <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center">
                        <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <circle cx="12" cy="8" r="2.5" stroke="#46608b" stroke-linecap="round"></circle>
                                <path
                                    d="M13.7679 6.5C13.9657 6.15743 14.2607 5.88121 14.6154 5.70625C14.9702 5.5313 15.3689 5.46548 15.7611 5.51711C16.1532 5.56874 16.5213 5.73551 16.8187 5.99632C17.1161 6.25713 17.3295 6.60028 17.4319 6.98236C17.5342 7.36445 17.521 7.76831 17.3939 8.14288C17.2667 8.51745 17.0313 8.8459 16.7175 9.08671C16.4037 9.32751 16.0255 9.46985 15.6308 9.49572C15.2361 9.52159 14.8426 9.42983 14.5 9.23205"
                                    stroke="#46608b"></path>
                                <path
                                    d="M10.2321 6.5C10.0343 6.15743 9.73935 5.88121 9.38458 5.70625C9.02981 5.5313 8.63113 5.46548 8.23895 5.51711C7.84677 5.56874 7.47871 5.73551 7.18131 5.99632C6.88391 6.25713 6.67053 6.60028 6.56815 6.98236C6.46577 7.36445 6.47899 7.76831 6.60614 8.14288C6.73329 8.51745 6.96866 8.8459 7.28248 9.08671C7.5963 9.32751 7.97448 9.46985 8.36919 9.49572C8.76391 9.52159 9.15743 9.42983 9.5 9.23205"
                                    stroke="#46608b"></path>
                                <path
                                    d="M12 12.5C16.0802 12.5 17.1335 15.8022 17.4054 17.507C17.4924 18.0524 17.0523 18.5 16.5 18.5H7.5C6.94771 18.5 6.50763 18.0524 6.59461 17.507C6.86649 15.8022 7.91976 12.5 12 12.5Z"
                                    stroke="#46608b" stroke-linecap="round"></path>
                                <path
                                    d="M19.2965 15.4162L18.8115 15.5377L19.2965 15.4162ZM13.0871 12.5859L12.7179 12.2488L12.0974 12.9283L13.0051 13.0791L13.0871 12.5859ZM17.1813 16.5L16.701 16.639L16.8055 17H17.1813V16.5ZM15.5 12C16.5277 12 17.2495 12.5027 17.7783 13.2069C18.3177 13.9253 18.6344 14.8306 18.8115 15.5377L19.7816 15.2948C19.5904 14.5315 19.2329 13.4787 18.578 12.6065C17.9126 11.7203 16.9202 11 15.5 11V12ZM13.4563 12.923C13.9567 12.375 14.6107 12 15.5 12V11C14.2828 11 13.3736 11.5306 12.7179 12.2488L13.4563 12.923ZM13.0051 13.0791C15.3056 13.4614 16.279 15.1801 16.701 16.639L17.6616 16.361C17.1905 14.7326 16.019 12.5663 13.1691 12.0927L13.0051 13.0791ZM18.395 16H17.1813V17H18.395V16ZM18.8115 15.5377C18.8653 15.7526 18.7075 16 18.395 16V17C19.2657 17 20.0152 16.2277 19.7816 15.2948L18.8115 15.5377Z"
                                    fill="#46608b"></path>
                                <path
                                    d="M10.9129 12.5859L10.9949 13.0791L11.9026 12.9283L11.2821 12.2488L10.9129 12.5859ZM4.70343 15.4162L5.18845 15.5377L4.70343 15.4162ZM6.81868 16.5V17H7.19453L7.29898 16.639L6.81868 16.5ZM8.49999 12C9.38931 12 10.0433 12.375 10.5436 12.923L11.2821 12.2488C10.6264 11.5306 9.71723 11 8.49999 11V12ZM5.18845 15.5377C5.36554 14.8306 5.68228 13.9253 6.22167 13.2069C6.75048 12.5027 7.47226 12 8.49999 12V11C7.0798 11 6.08743 11.7203 5.42199 12.6065C4.76713 13.4787 4.40955 14.5315 4.21841 15.2948L5.18845 15.5377ZM5.60498 16C5.29247 16 5.13465 15.7526 5.18845 15.5377L4.21841 15.2948C3.98477 16.2277 4.73424 17 5.60498 17V16ZM6.81868 16H5.60498V17H6.81868V16ZM7.29898 16.639C7.72104 15.1801 8.69435 13.4614 10.9949 13.0791L10.8309 12.0927C7.98101 12.5663 6.8095 14.7326 6.33838 16.361L7.29898 16.639Z"
                                    fill="#46608b"></path>
                            </g>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-slate-700 mb-0">
                            {{ animatedCustomer.toLocaleString() }}
                        </p>
                        <p class="text-slate-500 mb-0 ">Total Customers</p>
                    </div>
                </div>
            </div>


        </div>
        <div class="row !my-[50px]">
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
                <apexchart width="100%" height="313" type="bar" :options="columnChartOptions"
                    :series="columnChartSeries">
                </apexchart>

            </div>
        </div>
    </div>

</template>

<script setup>
import { computed, onMounted } from 'vue';
import { ref } from 'vue';

const props = defineProps({
    moviesByYear: Array,
    percentagesPerGenre: Array,
    totalBookingRevenue: Number,
    totalBookingTicket: Number,
    totalCustomers: Number,
});


const animatedRevenue = ref(0);
const animatedTicket = ref(0);
const animatedCustomer = ref(0);

const animateRevenue = (target, animatedValue) => {
    const duration = 2000;
    const increment = target / (duration / 50);
    let currentRevenue = 0;

    const interval = setInterval(() => {
        if (currentRevenue < target) {
            currentRevenue += increment;
            animatedValue.value = Math.round(currentRevenue);
        } else {
            animatedValue.value = target;
            clearInterval(interval);
        }
    }, 50);
};

onMounted(() => {
    animateRevenue(props.totalBookingRevenue, animatedRevenue);
    animateRevenue(props.totalBookingTicket, animatedTicket);
    animateRevenue(props.totalCustomers, animatedCustomer);
});


// const barChartOptions = ref({
//     chart: {
//         type: 'bar',
//     },
//     xaxis: {
//         type: 'category'
//     },
// });

// const barChartSeries = computed(() => {
//     return [
//         {
//             name: 'Series 1',
//             data: props.moviesByYear.map((item) => ({
//                 x: item.year,
//                 y: item.count
//             }))
//         },
//     ]
// });



const pieChartOptions = computed(() => ({
    chart: {
        type: 'pie',
        height: 100
    },
    labels: props.percentagesPerGenre.map((item) => item.genre),
    title: {
        text: 'Ticket Sales by Genre',
        style: {
            fontSize: '18px',
            color: "oklch(0.446 0.043 257.281)",
        }
    }
}));

const pieChartSeries = computed(() => {
    return props.percentagesPerGenre.map((item) => item.percentage);
});

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
