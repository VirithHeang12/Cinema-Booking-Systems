<template>
  <v-container class="my-[20px]">
    <section>
      <v-row class="mb-3">
        <v-col cols="12" md="6" lg="8">
          <h1 class="font-bold text-gray-800">{{ __("booking.title") }}</h1>
          <p class="m-0 text-md text-gray-700">
            {{ __("booking.subtitle") }}
          </p>
        </v-col>
      </v-row>

      <div class="row">
        <div class="col-12 col-md-8 mb-3">
          <div class="card rounded-4">
            <div class="card-body">
              <div
                v-for="row in seatRows"
                :key="row.label"
                class="seat-row"
              >
                <span class="row-label">{{ row.label }}</span>

                <div class="flex-grow flex justify-center">
                  <Seat
                    v-for="seat in row.seats"
                    :key="seat.id"
                    :seat-id="seat.id"
                    :seat-number="seat.number"
                    :status="seat.status"
                    @select="() => toggleSeat(seat.id)"
                  />
                </div>

                <span class="row-label">{{ row.label }}</span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="card rounded-4">
            <div class="card-body">
              <img
                src="https://i0.wp.com/teaser-trailer.com/wp-content/uploads/2025/01/How-to-Train-Your-Dragon-Movie-2025-Poster.jpg?ssl=1"
                class="!h-[200px] !w-full object-fit-cover mb-3 rounded-3"
              />

              <h5 class="card-title">Card title</h5>
              <h6 class="card-subtitle mb-2 text-body-secondary">
                Card subtitle
              </h6>
              <p class="card-text">
                Some quick example text to build on the card title and make up
                the bulk of the card's content.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </v-container>
</template>

<script setup>
  import { ref, onMounted } from "vue";
  import { __ } from "matice";
  import axios from "axios";
  import Seat from "../Components/Seat.vue";

  const showId = 14;
  const seatRows = ref([]);
  const selectedSeatIds = ref([]);

  const getSeats = async () => {
    try {
      const res = await axios.get(`/api/v1/shows/${showId}`);
      seatRows.value = res.data;
      console.log(res.data);
    } catch (error) {
      console.error("Error fetching seats:", error);
    }
  };

  onMounted(() => getSeats());

  function toggleSeat(seatId) {
  for (const row of seatRows.value) {
    for (const seat of row.seats) {
      if (seat.id === seatId && seat.status !== "unavailable") {
        if (seat.status === "selected") {
          seat.status = "available";
          selectedSeatIds.value = selectedSeatIds.value.filter(id => id !== seatId);
        } else {
          seat.status = "selected";
          selectedSeatIds.value.push(seatId);
        }
        return; // exit early once matched
      }
    }
  }
}


//   const seatRows = reactive([
//     {
//       label: "A",
//       seats: [
//         { id: "A1", number: 1, status: "available" },
//         { id: "A2", number: 2, status: "unavailable" },
//         { id: "A3", number: 3, status: "available" },
//       ],
//     },
//     {
//       label: "B",
//       seats: [
//         { id: "B1", number: 1, status: "available" },
//         { id: "B2", number: 2, status: "selected" },
//         { id: "B3", number: 3, status: "available" },
//       ],
//     },
//   ]);
//   function toggleSeat(seatId) {
//     for (const row of seatRows) {
//       for (const seat of row.seats) {
//         if (seat.id === seatId && seat.status !== "unavailable") {
//           seat.status = seat.status === "selected" ? "available" : "selected";
//         }
//       }
//     }
//   }
</script>

<style scoped>
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
    color: #494141;
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
</style>
