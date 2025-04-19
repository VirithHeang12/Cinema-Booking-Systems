<template>
    <div class="bg-gray-50 min-h-screen">
        <!-- Header with greeting and date -->
        <div class="bg-white border-b border-gray-200 ">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ __('Movie Booking Analytics') }}</h1>
                        <p class="text-gray-500">{{ __('Overview of your cinema performance') }}</p>
                    </div>
                    <div class="flex items-center space-x-2 bg-blue-50 px-4 py-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span class="text-sm font-medium text-blue-600">{{ new Date().toLocaleDateString('en-US',
                            { year: 'numeric', month: 'long', day: 'numeric' }) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total Revenue Card -->
                <div
                    class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-all duration-300 border border-gray-100">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-4 rounded-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                                <line x1="2" y1="10" x2="22" y2="10"></line>
                            </svg>
                        </div>
                        <div class="mt-3">
                            <p class="text-sm font-medium text-gray-500">{{ __('Total Revenue') }}</p>
                            <div class="flex items-baseline">
                                <p class="text-2xl font-bold text-gray-900">${{ animatedRevenue.toLocaleString() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Tickets Card -->
                <div
                    class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-all duration-300 border border-gray-100">
                    <div class="flex items-center">
                        <div class="bg-green-100 p-4 rounded-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M5 12.0002C5 10.694 4.16519 9.58273 3 9.1709V7.6C3 7.03995 3 6.75992 3.10899 6.54601C3.20487 6.35785 3.35785 6.20487 3.54601 6.10899C3.75992 6 4.03995 6 4.6 6H19.4C19.9601 6 20.2401 6 20.454 6.10899C20.6422 6.20487 20.7951 6.35785 20.891 6.54601C21 6.75992 21 7.03995 21 7.6V9.17071C19.8348 9.58254 19 10.694 19 12.0002C19 13.3064 19.8348 14.4175 21 14.8293V16.4C21 16.9601 21 17.2401 20.891 17.454C20.7951 17.6422 20.6422 17.7951 20.454 17.891C20.2401 18 19.9601 18 19.4 18H4.6C4.03995 18 3.75992 18 3.54601 17.891C3.35785 17.7951 3.20487 17.6422 3.10899 17.454C3 17.2401 3 16.9601 3 16.4V14.8295C4.16519 14.4177 5 13.3064 5 12.0002Z">
                                </path>
                            </svg>
                        </div>
                        <div class="mt-3">
                            <p class="text-sm font-medium text-gray-500">{{ __('Total Tickets') }}</p>
                            <div class="flex items-baseline mt-1">
                                <p class="text-2xl font-bold text-gray-900">{{ animatedTicket.toLocaleString() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Movies Card -->
                <div
                    class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-all duration-300 border border-gray-100">
                    <div class="flex items-center">
                        <div class="bg-purple-100 p-4 rounded-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"></rect>
                                <line x1="7" y1="2" x2="7" y2="22"></line>
                                <line x1="17" y1="2" x2="17" y2="22"></line>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <line x1="2" y1="7" x2="7" y2="7"></line>
                                <line x1="2" y1="17" x2="7" y2="17"></line>
                                <line x1="17" y1="17" x2="22" y2="17"></line>
                                <line x1="17" y1="7" x2="22" y2="7"></line>
                            </svg>
                        </div>
                        <div class="mt-3">
                            <p class="text-sm font-medium text-gray-500">{{ __('Total Movies') }}</p>
                            <div class="flex items-baseline mt-1">
                                <p class="text-2xl font-bold text-gray-900">{{ animatedMovies.toLocaleString() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row 1 -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Pie Chart -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">{{ __('Ticket Sales by Genre') }}</h2>
                        <div class="bg-blue-50 px-3 py-1 rounded-full text-xs font-medium text-blue-600">
                            {{ __('This Month') }}
                        </div>
                    </div>
                    <div class="h-64">
                        <apexchart type="pie" height="100%" :options="pieChartOptions" :series="pieChartSeries">
                        </apexchart>
                    </div>
                </div>

                <!-- Area Chart -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">{{ __('Booking Trends Per Month') }}</h2>
                        <div class="bg-blue-50 px-3 py-1 rounded-full text-xs font-medium text-blue-600">
                            {{ __('Last 4 Months') }}
                        </div>
                    </div>
                    <div class="h-64">
                        <apexchart type="area" height="100%" :options="areaChartOptions" :series="areaChartSeries">
                        </apexchart>
                    </div>
                </div>
            </div>

            <!-- Movies per Genre Chart -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">{{ __('Movies per Genre') }}</h2>
                    <div class="bg-blue-50 px-3 py-1 rounded-full text-xs font-medium text-blue-600">
                        {{ __('All Time') }}
                    </div>
                </div>
                <div class="h-80">
                    <apexchart type="bar" height="100%" :options="columnChartOptions" :series="columnChartSeries">
                    </apexchart>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref, computed, onMounted } from 'vue';
    import { __ } from 'matice';

    const props = defineProps({
        moviesByYear: Array,
        percentagesPerGenre: {
            type: Array,
            default: () => [
                { genre: 'Action', percentage: 38.9 },
                { genre: 'Adventure', percentage: 38.9 },
                { genre: 'Fantasy', percentage: 22.2 }
            ]
        },
        totalBookingRevenue: {
            type: Number,
            default: 12000000
        },
        totalBookingTicket: {
            type: Number,
            default: 175000
        },
        totalMovies: {
            type: Number,
            default: 885
        },
        bookingTrends: {
            type: Array,
            default: () => [
                { month: 1, name: 'January', total_bookings: 5 },
                { month: 2, name: 'February', total_bookings: 10 },
                { month: 3, name: 'March', total_bookings: 10 },
                { month: 4, name: 'April', total_bookings: 0 }
            ]
        },
        moviesCountByGenre: {
            type: Array,
            default: () => [
                { genre: 'Action', count: 120 },
                { genre: 'Adventure', count: 95 },
                { genre: 'Drama', count: 160 },
                { genre: 'Fantasy', count: 80 },
                { genre: 'Horror', count: 60 },
                { genre: 'Mystery', count: 70 },
                { genre: 'Romance', count: 110 },
                { genre: 'Sci-Fi', count: 90 },
                { genre: 'Thriller', count: 100 }
            ]
        }
    });

    // Animated values for counters
    const animatedRevenue = ref(0);
    const animatedTicket = ref(0);
    const animatedMovies = ref(0);

    const animateValue = (target, animatedValue) => {
        const duration = 2000;
        const increment = target / (duration / 50);
        let currentValue = 0;

        const interval = setInterval(() => {
            if (currentValue < target) {
                currentValue += increment;
                animatedValue.value = Math.round(currentValue);
            } else {
                animatedValue.value = target;
                clearInterval(interval);
            }
        }, 50);
    };

    onMounted(() => {
        animateValue(props.totalBookingRevenue, animatedRevenue);
        animateValue(props.totalBookingTicket, animatedTicket);
        animateValue(props.totalMovies, animatedMovies);
    });

    // Pie Chart Configuration
    const pieChartOptions = computed(() => ({
        chart: {
            type: 'pie',
            fontFamily: 'Inter, sans-serif',
            toolbar: {
                show: false
            }
        },
        labels: props.percentagesPerGenre.map(item => item.genre),
        colors: ['#3B82F6', '#10B981', '#F59E0B'],
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            fontSize: '14px'
        },
        dataLabels: {
            enabled: true,
            formatter: (val) => `${Math.round(val)}%`
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    height: 300
                },
                legend: {
                    position: 'bottom'
                }
            }
        }],
        stroke: {
            width: 0
        },
        tooltip: {
            style: {
                fontSize: '14px'
            },
            y: {
                formatter: (val) => `${val}%`
            }
        }
    }));

    const pieChartSeries = computed(() =>
        props.percentagesPerGenre.map(item => item.percentage)
    );

    // Area Chart Configuration
    const areaChartOptions = computed(() => ({
        chart: {
            type: 'area',
            fontFamily: 'Inter, sans-serif',
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        colors: ['#3B82F6'],
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.1,
                stops: [0, 90, 100]
            }
        },
        xaxis: {
            categories: props.bookingTrends.map(item => item.name),
            labels: {
                style: {
                    fontSize: '12px'
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    fontSize: '12px'
                }
            }
        },
        tooltip: {
            y: {
                formatter: (val) => `${val} bookings`
            }
        },
        grid: {
            borderColor: '#f1f1f1',
            strokeDashArray: 4,
            yaxis: {
                lines: {
                    show: true
                }
            }
        },
        markers: {
            size: 5,
            colors: ['#3B82F6'],
            strokeColors: '#FFFFFF',
            strokeWidth: 2
        }
    }));

    const areaChartSeries = computed(() => [
        {
            name: 'Bookings',
            data: props.bookingTrends.map(item => item.total_bookings)
        }
    ]);

    // Column Chart Configuration
    const columnChartOptions = computed(() => ({
        chart: {
            type: 'bar',
            fontFamily: 'Inter, sans-serif',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                columnWidth: '55%',
                distributed: true,
            }
        },
        colors: [
            '#EF4444', '#3B82F6', '#1F2937', '#F59E0B',
            '#8B5CF6', '#6B7280', '#10B981', '#EC4899', '#F43F5E'
        ],
        dataLabels: {
            enabled: true,
            formatter: (val) => val,
            style: {
                fontSize: '12px',
                colors: ['#FFFFFF']
            }
        },
        legend: {
            show: false
        },
        xaxis: {
            categories: props.moviesCountByGenre.map(item => item.genre),
            labels: {
                style: {
                    fontSize: '12px'
                }
            }
        },
        yaxis: {
            title: {
                text: 'Number of Movies'
            }
        },
        tooltip: {
            y: {
                formatter: (val) => `${val} movies`
            }
        },
        grid: {
            borderColor: '#f1f1f1',
            strokeDashArray: 4
        }
    }));

    const columnChartSeries = ref([
        {
            name: 'Movies',
            data: props.moviesCountByGenre.map(item => item.count)
        }
    ]);
</script>
