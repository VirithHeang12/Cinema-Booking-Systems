<template>
    <div class="container mt-4">
        <div class="row g-5">
            <div class="col-12 col-md-4">
                <div class="border p-3 rounded-3">
                    <div class="d-flex items-center gap-3">
                        <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center ms-2">
                            <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.948 1.25H12.052C12.9505 1.24997 13.6997 1.24995 14.2945 1.32991C14.9223 1.41432 15.4891 1.59999 15.9445 2.05546C16.4 2.51093 16.5857 3.07773 16.6701 3.70552C16.7292 4.14512 16.7446 4.66909 16.7486 5.27533C17.3971 5.29614 17.9752 5.33406 18.489 5.40314C19.6614 5.56076 20.6104 5.89288 21.3588 6.64124C22.1071 7.38961 22.4392 8.33856 22.5969 9.51098C22.75 10.6502 22.75 12.1058 22.75 13.9436V14.0564C22.75 15.8942 22.75 17.3498 22.5969 18.489C22.4392 19.6614 22.1071 20.6104 21.3588 21.3588C20.6104 22.1071 19.6614 22.4392 18.489 22.5969C17.3498 22.75 15.8942 22.75 14.0564 22.75H9.94359C8.10583 22.75 6.65019 22.75 5.51098 22.5969C4.33856 22.4392 3.38961 22.1071 2.64124 21.3588C1.89288 20.6104 1.56076 19.6614 1.40314 18.489C1.24997 17.3498 1.24998 15.8942 1.25 14.0564V13.9436C1.24998 12.1058 1.24997 10.6502 1.40314 9.51098C1.56076 8.33856 1.89288 7.38961 2.64124 6.64124C3.38961 5.89288 4.33856 5.56076 5.51098 5.40314C6.02475 5.33406 6.60288 5.29614 7.2514 5.27533C7.2554 4.66909 7.27081 4.14512 7.32991 3.70552C7.41432 3.07773 7.59999 2.51093 8.05546 2.05546C8.51093 1.59999 9.07773 1.41432 9.70552 1.32991C10.3003 1.24995 11.0495 1.24997 11.948 1.25ZM8.7518 5.25178C9.12993 5.24999 9.52694 5.25 9.94358 5.25H14.0564C14.4731 5.25 14.8701 5.24999 15.2482 5.25178C15.244 4.68146 15.23 4.25125 15.1835 3.90539C15.1214 3.44393 15.0142 3.24644 14.8839 3.11612C14.7536 2.9858 14.5561 2.87858 14.0946 2.81654C13.6116 2.7516 12.964 2.75 12 2.75C11.036 2.75 10.3884 2.7516 9.90539 2.81654C9.44393 2.87858 9.24643 2.9858 9.11612 3.11612C8.9858 3.24644 8.87858 3.44393 8.81654 3.90539C8.77004 4.25125 8.75601 4.68146 8.7518 5.25178ZM5.71085 6.88976C4.70476 7.02503 4.12511 7.2787 3.7019 7.70191C3.27869 8.12511 3.02502 8.70476 2.88976 9.71085C2.75159 10.7385 2.75 12.0932 2.75 14C2.75 15.9068 2.75159 17.2615 2.88976 18.2892C3.02502 19.2952 3.27869 19.8749 3.7019 20.2981C4.12511 20.7213 4.70476 20.975 5.71085 21.1102C6.73851 21.2484 8.09318 21.25 10 21.25H14C15.9068 21.25 17.2615 21.2484 18.2892 21.1102C19.2952 20.975 19.8749 20.7213 20.2981 20.2981C20.7213 19.8749 20.975 19.2952 21.1102 18.2892C21.2484 17.2615 21.25 15.9068 21.25 14C21.25 12.0932 21.2484 10.7385 21.1102 9.71085C20.975 8.70476 20.7213 8.12511 20.2981 7.70191C19.8749 7.2787 19.2952 7.02503 18.2892 6.88976C17.2615 6.7516 15.9068 6.75 14 6.75H10C8.09318 6.75 6.73851 6.7516 5.71085 6.88976ZM12 9.25C12.4142 9.25 12.75 9.58579 12.75 10V10.0102C13.8388 10.2845 14.75 11.143 14.75 12.3333C14.75 12.7475 14.4142 13.0833 14 13.0833C13.5858 13.0833 13.25 12.7475 13.25 12.3333C13.25 11.9493 12.8242 11.4167 12 11.4167C11.1758 11.4167 10.75 11.9493 10.75 12.3333C10.75 12.7174 11.1758 13.25 12 13.25C13.3849 13.25 14.75 14.2098 14.75 15.6667C14.75 16.857 13.8388 17.7155 12.75 17.9898V18C12.75 18.4142 12.4142 18.75 12 18.75C11.5858 18.75 11.25 18.4142 11.25 18V17.9898C10.1612 17.7155 9.25 16.857 9.25 15.6667C9.25 15.2525 9.58579 14.9167 10 14.9167C10.4142 14.9167 10.75 15.2525 10.75 15.6667C10.75 16.0507 11.1758 16.5833 12 16.5833C12.8242 16.5833 13.25 16.0507 13.25 15.6667C13.25 15.2826 12.8242 14.75 12 14.75C10.6151 14.75 9.25 13.7903 9.25 12.3333C9.25 11.143 10.1612 10.2845 11.25 10.0102V10C11.25 9.58579 11.5858 9.25 12 9.25Z" fill="#46608b"></path>
                                </g>
                            </svg>
                        </div>
                        <div>
                            <p class="text-zinc-500 text-uppercase text-sm tracking-wide font-medium my-2">
                                Total Booking Revenue
                            </p>
                            <p class="text-2xl font-bold text-zinc-700 mb-1">
                                ${{ animatedRevenue.toLocaleString() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="border p-3 rounded-3">
                    <div class="d-flex items-center gap-3">
                        <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center ms-2">
                            <svg width="38px" height="38px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M5 12.0002C5 10.694 4.16519 9.58273 3 9.1709V7.6C3 7.03995 3 6.75992 3.10899 6.54601C3.20487 6.35785 3.35785 6.20487 3.54601 6.10899C3.75992 6 4.03995 6 4.6 6H19.4C19.9601 6 20.2401 6 20.454 6.10899C20.6422 6.20487 20.7951 6.35785 20.891 6.54601C21 6.75992 21 7.03995 21 7.6V9.17071C19.8348 9.58254 19 10.694 19 12.0002C19 13.3064 19.8348 14.4175 21 14.8293V16.4C21 16.9601 21 17.2401 20.891 17.454C20.7951 17.6422 20.6422 17.7951 20.454 17.891C20.2401 18 19.9601 18 19.4 18H4.6C4.03995 18 3.75992 18 3.54601 17.891C3.35785 17.7951 3.20487 17.6422 3.10899 17.454C3 17.2401 3 16.9601 3 16.4V14.8295C4.16519 14.4177 5 13.3064 5 12.0002Z" stroke="#46608b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </div>
                        <div>
                            <p class="text-zinc-500 text-uppercase text-sm tracking-wide font-medium my-2">
                                Total Booking Tickets
                            </p>
                            <p class="text-2xl font-bold text-zinc-700 mb-1">
                                {{ animatedTicket.toLocaleString() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="border p-3 rounded-3">
                    <div class="d-flex items-center gap-3">
                        <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center ms-2">
                            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" viewBox="0 0 512 512" xml:space="preserve" fill="#46608B">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <path class="st0" d="M90.734,210.977c22.547,0.016,43.172-9.203,57.922-24c14.781-14.734,24-35.359,24-57.906 s-9.219-43.188-24-57.938c-14.75-14.781-35.375-24-57.922-23.984c-22.547-0.016-43.172,9.203-57.922,24 c-14.781,14.734-24,35.375-23.984,57.922c-0.016,22.547,9.203,43.156,23.984,57.906C47.563,201.773,68.188,210.992,90.734,210.977z M66.109,104.43c6.375-6.344,14.938-10.188,24.625-10.203c9.703,0.016,18.25,3.859,24.641,10.203 c6.328,6.375,10.188,14.938,10.188,24.641c0,9.688-3.859,18.234-10.188,24.625c-6.391,6.328-14.938,10.188-24.641,10.203 c-9.688-0.016-18.25-3.875-24.625-10.203c-6.344-6.391-10.188-14.938-10.203-24.625C55.922,119.367,59.766,110.805,66.109,104.43z"></path>
                                        <path class="st0" d="M270.219,210.977c22.547,0.016,43.172-9.203,57.922-24c14.781-14.75,24-35.359,23.984-57.906 c0.016-22.547-9.203-43.188-23.984-57.922c-14.75-14.797-35.375-24.016-57.922-24c-22.531-0.016-43.172,9.203-57.922,23.984 c-14.797,14.75-24,35.391-23.984,57.938c-0.016,22.547,9.203,43.172,23.984,57.906 C227.047,201.773,247.688,210.992,270.219,210.977z M245.594,104.43c6.375-6.344,14.938-10.188,24.625-10.203 c9.688,0.016,18.25,3.859,24.625,10.203c6.344,6.375,10.188,14.938,10.203,24.641c-0.016,9.688-3.859,18.234-10.203,24.625 c-6.375,6.328-14.938,10.188-24.625,10.203c-9.688-0.016-18.25-3.875-24.625-10.203c-6.344-6.391-10.188-14.938-10.203-24.625 C235.406,119.367,239.25,110.805,245.594,104.43z"></path>
                                        <path class="st0" d="M313.047,224.195H45.953c-12.625-0.016-24.234,5.172-32.5,13.453C5.172,245.914,0,257.523,0,270.148v148.75 c0,12.625,5.172,24.25,13.453,32.5c8.266,8.281,19.875,13.469,32.5,13.453h267.094c12.609,0.016,24.234-5.172,32.484-13.453 c8.297-8.25,13.484-19.875,13.469-32.5v-148.75c0.016-12.625-5.172-24.234-13.469-32.5 C337.281,229.367,325.656,224.18,313.047,224.195z M317.813,418.898c-0.031,1.391-0.516,2.453-1.406,3.375 c-0.922,0.891-1.984,1.375-3.359,1.391H45.953c-1.391-0.016-2.438-0.5-3.359-1.391c-0.891-0.922-1.375-1.984-1.406-3.375v-148.75 c0.031-1.375,0.516-2.438,1.406-3.375c0.922-0.875,1.969-1.375,3.359-1.391h267.094c1.375,0.016,2.438,0.516,3.359,1.391 c0.891,0.938,1.375,2,1.406,3.375V418.898z"></path>
                                        <path class="st0" d="M493.875,236.414c-5.828-3.516-12.531-5.359-19.125-5.359c-6.063,0-12.063,1.484-17.609,4.422l-73.734,39.313 v46.719l87.406-46.594v139.297l-87.406-46.672v46.734l73.734,39.297c5.547,2.953,11.547,4.422,17.609,4.422 c6.594,0,13.297-1.766,19.188-5.297C505.125,445.93,512,433.805,512,420.68V268.367C512,255.242,505.125,243.117,493.875,236.414z"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div>
                            <p class="text-zinc-500 text-uppercase text-sm tracking-wide font-medium my-2">
                                Total Movies
                            </p>
                            <p class="text-2xl font-bold text-zinc-700 mb-1">
                                {{ animatedMovies.toLocaleString() }}
                            </p>
                        </div>
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

            <div class="col-12 col-md-6">
                <div class="border p-2 pb-0 rounded-3">
                    <apexchart width="100%" height="310" type="area" :options="areaChartOptions" :series="areaChartSeries"></apexchart>
                </div>
            </div>
        </div>

        <apexchart width="500" type="bar" :options="barChartOptions" :series="barChartSeries"></apexchart>

        <div class="col-12 col-md-6">
            <div class="border p-2 rounded-3">
                <apexchart width="100%" height="313" type="bar" :options="columnChartOptions" :series="columnChartSeries">
                </apexchart>
            </div>
        </div>
    </div>
</template>

<script setup>
  import { computed, onMounted } from "vue";
  import { ref } from "vue";

  const props = defineProps({
    moviesByYear: Array,
    percentagesPerGenre: Array,
    totalBookingRevenue: Number,
    totalBookingTicket: Number,
    totalMovies: Number,
    bookingTrends: Array,
  });

  const animatedRevenue = ref(0);
  const animatedTicket = ref(0);
  const animatedMovies = ref(0);

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
    animateRevenue(props.totalMovies, animatedMovies);
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
      type: "pie",
      height: 100,
    },
    labels: props.percentagesPerGenre.map((item) => item.genre),
    title: {
      text: "Ticket Sales by Genre",
      style: {
        fontSize: "18px",
        color: "#3F3F46",
        margin: "20px",
      },
    },
  }));

  const pieChartSeries = computed(() => {
    return props.percentagesPerGenre.map((item) => item.percentage);
  });

  // Spline Area Chart Options
  const areaChartOptions = computed(() => ({
  chart: {
    type: "area",
    height: 100,
    toolbar: {
      tools: {
        zoomin: false,
        zoomout: false,
        zoom: false,
        pan: false,
        reset: false,
      },
    },
  },
  title: {
    text: "Booking Trends Per Month",
    style: {
      fontSize: "18px",
      color: "#3F3F46",
    },
  },
  xaxis: {
    categories: props.bookingTrends.map((item) => {
      const monthNames = [
        "January", "February", "March", "April", "May", "June", "July", "August",
        "September", "October", "November", "December"
      ];
      return monthNames[item.month - 1];
    }),
  },
  fill: {
    type: "gradient",
    gradient: {
      shade: "light",
      type: "vertical",
      gradientToColors: ["#abe3f4"],
      stops: [0, 100],
    },
  },
  stroke: {
    curve: "smooth",
  },
}));


  // Spline Area Chart Series
  const areaChartSeries = computed(() => [
    {
      name: "Bookings",
      data: props.bookingTrends.map((item) => item.total_bookings),
    },
  ]);

  const colors = [
    "#FF4560",
    "#008FFB",
    "#000000",
    "#FEB019",
    "#775DD0",
    "#546E7A",
    "#26A69A",
    "#D10CE8",
  ];

  const columnChartOptions = ref({
    chart: {
      type: "bar",
      height: 350,
    },
    plotOptions: {
      bar: {
        columnWidth: "45%",
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
      text: "Movies per Genre",
      style: {
        fontSize: "18px",
        color: "#3F3F46",
      },
    },
  });

  const columnChartSeries = ref([
    {
      name: "Number of Movies",
      data: [
        { x: "Action", y: 120 },
        { x: "Adventure", y: 95 },
        { x: "Drama", y: 160 },
        { x: "Fantasy", y: 80 },
        { x: "Horror", y: 60 },
        { x: "Mystery", y: 70 },
        { x: "Romance", y: 110 },
        { x: "Sci-Fi", y: 90 },
        { x: "Thriller", y: 100 },
      ],
    },
  ]);
</script>
