<template>
  <v-container class="my-[20px]">
    <section>
      <v-row class="mb-3">
        <v-col cols="12" md="6" lg="8">
          <h1 class="font-bold text-zinc-100">{{ __("booking.title") }}</h1>
          <p class="m-0 text-md text-zinc-100">
            {{ __("booking.subtitle") }}
          </p>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="12" md="8">
          <div class="card" v-if="!showPaymentSection">
            <div class="card-body">
              <div v-for="row in seats" :key="row.label" class="seat-row">
                <span class="row-label">{{ row.label }}</span>

                <div class="flex-grow flex justify-center">
                  <Seat
                    v-for="seat in row.seats"
                    :key="seat.id"
                    :seat-id="seat.id"
                    :seat-number="seat.number"
                    :seat-type="row.seatType?.name"
                    :status="seat.status"
                    @select="() => toggleSeat(seat.id)"
                  />
                </div>

                <span class="row-label">{{ row.label }}</span>
              </div>

              <!-- Seat Type Legend -->
              <div class="legend">
                <div
                  v-for="seatType in seatTypes"
                  :key="seatType.name"
                  class="flex flex-col items-center gap-1"
                >
                  <span class="text-xs text-zinc-200 font-normal">
                    {{ seatType.name }}
                  </span>
                  <img
                    :src="getLegendImage(seatType.name)"
                    alt="Seat type"
                    class="w-10 h-10"
                  />
                  <span class="text-sm text-zinc-200 font-medium">
                    $ {{ formatPrice(seatType.price) }}
                  </span>
                </div>
              </div>
            </div>
          </div>

          <!-- Payment Section -->
          <div class="card !text-zinc-300" v-if="showPaymentSection">
            <div class="card-body p-4 space-y-5">
              <h3 class="text-lg font-semibold">Payment Info</h3>

              <!-- Payment Method Select -->
              <v-select
                v-model="form.payment_method_id"
                :items="paymentMethods"
                item-title="name"
                item-value="id"
                label="Select Payment Method"
                prepend-inner-icon="mdi-credit-card"
                variant="outlined"
                hide-details
                clearable
                solo
                class="text-zinc-200"
              />

              <!-- Guest Email Field -->
              <v-text-field
                v-model="form.guest_email"
                label="Guest Email (optional)"
                type="email"
                prepend-inner-icon="mdi-email"
                variant="outlined"
                hide-details
                clearable
                solo
                class="text-zinc-200"
              />

              <!-- Submit Button -->
              <div class="flex justify-end pt-4">
                <v-btn
                  class="!font-semibold"
                  variant="flat"
                  color="#991f1f"
                  @click="submitPayment"
                >
                  Submit Payment
                </v-btn>
              </div>
            </div>
          </div>
        </v-col>

        <v-col cols="12" md="4">
          <div class="card !text-zinc-200">
            <div class="card-body">
              <!-- Movie Thumbnail -->
              <img
                :src="movie.thumbnail_url"
                :alt="movie.title"
                class="!h-[200px] !w-full object-fit-cover mb-3 rounded-4"
              />

              <!-- Movie Details -->
              <div class="movie-details-container relative space-y-3 my-4 pb-5">
                <div class="flex justify-between items-start gap-4">
                  <span class="font-medium text-gray-300 w-12">Movie</span>
                  <span class="vertical-colon">:</span>
                  <span class="text-md flex-1 text-right">{{
                    movie.title
                  }}</span>
                </div>

                <div class="flex justify-between items-start gap-4">
                  <span class="font-medium text-gray-300 w-12">Date</span>
                  <span class="vertical-colon">:</span>
                  <span class="text-md flex-1 text-right">{{ showDate }}</span>
                </div>

                <div class="flex justify-between items-start gap-4">
                  <span class="font-medium text-gray-300 w-12">Time</span>
                  <span class="vertical-colon">:</span>
                  <span class="text-md flex-1 text-right">{{ showTime }}</span>
                </div>

                <div class="flex justify-between items-start gap-4">
                  <span class="font-medium text-gray-300 w-12">Hall</span>
                  <span class="vertical-colon">:</span>
                  <span class="text-md flex-1 text-right">{{
                    show.hall.name
                  }}</span>
                </div>
              </div>

              <!-- Selected Seats -->
              <div class="my-4">
                <h6 class="text-md font-bold text-zinc-200">Selected Seats:</h6>
                <div class="flex flex-wrap gap-2 mt-3">
                  <v-chip
                    v-for="label in selectedSeatLabels"
                    :key="label"
                    color="white"
                    class="px-3 !font-semibold"
                    variant="tonal"
                    size="small"
                  >
                    {{ label }}
                  </v-chip>
                  <span
                    v-if="selectedSeatLabels.length === 0"
                    class="text-sm font-italic text-zinc-400"
                    >None</span
                  >
                </div>
              </div>

              <div
                class="bg-white/10 rounded-3 px-5 py-4 flex justify-between items-center"
              >
                <h6 class="text-md font-semibold !mb-0">Total Amount :</h6>
                <span class="text-xl font-bold text-white"
                  >$ {{ totalAmount }}</span
                >
              </div>

              <div class="flex justify-center mt-4">
                <v-btn
                  color="#991f1f"
                  class="!font-semibold w-full"
                  :variant="showPaymentSection ? 'outlined' : 'flat'"
                  :class="selectedSeatIds.length > 0 ? '' : 'd-none'"
                  @click="handleContinue"
                >
                  {{ showPaymentSection ? "Back to seats" : "Continue" }}
                </v-btn>
              </div>
            </div>
          </div>
        </v-col>
      </v-row>
    </section>
  </v-container>
</template>

<script setup>
  import { computed, ref } from "vue";
  import { __ } from "matice";
  import dayjs from "dayjs";
  import { useForm } from "@inertiajs/vue3";
  import Seat from "../Components/Seat.vue";

  const props = defineProps({
    movie: {
      type: Object,
      required: true,
    },
    show: {
      type: Object,
      required: true,
    },
    seatRows: {
      type: Array,
      required: true,
    },
    seatTypes: {
      type: Array,
      required: true,
    },
    paymentMethods: {
      type: Array,
      required: true,
    },
  });

  const selectedSeatIds = ref([]);
  const showPaymentSection = ref(false);

  const seats = computed(() => {
    return props.seatRows.map((row) => {
      return {
        label: row.label,
        seatType: row.seatType,
        seats: row.seats.map((seat) => {
          return {
            ...seat,
            status: selectedSeatIds.value.includes(seat.id)
              ? "selected"
              : seat.status,
          };
        }),
      };
    });
  });

  const totalAmount = computed(() => {
    return selectedSeatIds.value.reduce((total, seatId) => {
      const row = props.seatRows.find((row) =>
        row.seats.some((seat) => seat.id === seatId)
      );
      return total + (row?.seatType?.price ?? 0);
    }, 0);
  });

  /**
   * Toggle the seat status between available and selected
   *
   * @param seatId
   *
   * @returns {void}
   */
  function toggleSeat(seatId) {
    if (selectedSeatIds.value.includes(seatId)) {
      selectedSeatIds.value = selectedSeatIds.value.filter((id) => id !== seatId);
    } else {
      selectedSeatIds.value.push(seatId);
    }
  }

  function getLegendImage(seatTypeName) {
    return seatTypeName === "Regular"
      ? "/image/seats/available.png"
      : "/image/seats/available-gold.png";
  }

  function formatPrice(price) {
    return Number(price).toFixed(2);
  }

  //   display selected seat
  const selectedSeatLabels = computed(() => {
    return selectedSeatIds.value
      .map((seatId) => {
        const row = props.seatRows.find((row) =>
          row.seats.some((seat) => seat.id === seatId)
        );
        const seat = row?.seats.find((seat) => seat.id === seatId);

        if (row && seat) {
          return `${row.label}${seat.number}`;
        }

        return null;
      })
      .filter((label) => label !== null);
  });

  const showDate = computed(() =>
    dayjs(props.show.show_time).format("dddd, MMMM D, YYYY")
  );

  const showTime = computed(() => dayjs(props.show.show_time).format("h:mm A"));

  function handleContinue() {
    showPaymentSection.value = !showPaymentSection.value;
  }

  const form = useForm({
    show_id: props.show.id,
    selected_seat_ids: [],
    total_amount: 0,
    payment_method_id: null,
    guest_email: "",
  });

  function submitPayment() {
    form.selected_seat_ids = selectedSeatIds.value;
    form.total_amount = totalAmount.value;

    form.post(route("shows.booking.store", { show: props.show.id }), {
      onSuccess: () => {
        selectedSeatIds.value = []; // Clear selection
      },
      onError: (errors) => {
        console.error("Form submission error:", errors);
      },
    });
  }
</script>

<style scoped>
  .card {
    background: rgba(0, 0, 0, 0.3);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(223, 223, 223, 0.2);
  }
  .booking-page {
    padding: 20px;
  }

  .seat-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
  }

  .row-label {
    color: #d3d3d3;
    width: 30px;
    font-weight: bold;
    margin-right: 10px;
    text-align: center;
  }

  .selected-info {
    margin-top: 20px;
    background: #f7f7f7;
    padding: 10px;
    border-radius: 6px;
  }
  .legend {
    position: relative;
    padding-top: 15px;
    margin-top: 20px !important;
    color: #d3d3d3;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
  }

  .legend::before,
  .movie-details-container::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 1px;
    background: linear-gradient(
      to right,
      rgba(255, 255, 255, 0),
      rgba(255, 255, 255, 0.4),
      rgba(255, 255, 255, 0)
    );
  }
  .movie-details-container::after {
    bottom: 0;
    top: auto;
  }
</style>
