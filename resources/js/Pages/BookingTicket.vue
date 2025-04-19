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
          <div class="card">
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
              <div class="legend">safdasdf</div>
            </div>
          </div>
        </v-col>

        <v-col cols="12" md="4">
          <div class="card">
            <div class="card-body">
              <img
                :src="movie.thumbnail_url"
                :alt="movie.title"
                class="!h-[200px] !w-full object-fit-cover mb-3 rounded-3"
              />

              <h5 class="card-title">Movie: {{ movie.title }}</h5>
              <h5 class="card-title">Time: {{ show.show_time }}</h5>
              <h5 class="card-title">Date: {{ show.show_time }}</h5>
              <h5 class="card-title">Hall: {{ show.hall.name }}</h5>

              <h6 class="card-subtitle mb-2 text-body-secondary">
                {{ totalAmount }}
              </h6>
              <p class="card-text">
                Some quick example text to build on the card title and make up
                the bulk of the card's content.
              </p>
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
  });

  const selectedSeatIds = ref([]);

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
      const seat = props.seatRows
        .flatMap((row) => row.seats)
        .find((seat) => seat.id === seatId);
      return total + (seat ? seat.price : 0);
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
  }

  .legend::before {
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
</style>
