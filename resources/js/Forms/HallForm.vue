<template>
    <div class="form-content">
        <!-- Hall Name -->
        <vee-field name="name" v-slot="{ field, errors }">
            <div class="mb-6">
                <v-text-field v-bind="field" :error-messages="errors" v-model="form.name" variant="outlined"
                    density="comfortable" :placeholder="__('Enter Hall Name')" class="rounded-lg" bg-color="surface"
                    hide-details="auto" prepend-inner-icon="mdi-chair-rolling"></v-text-field>
            </div>
        </vee-field>

        <!-- Description -->
        <vee-field name="description" v-slot="{ field, errors }">
            <div class="mb-6">
                <v-textarea v-bind="field" :error-messages="errors" v-model="form.description" variant="outlined"
                    rows="3" auto-grow :placeholder="__('Enter Hall Description')" class="rounded-lg" bg-color="surface"
                    hide-details="auto" prepend-inner-icon="mdi-text-box-outline"></v-textarea>
            </div>
        </vee-field>

        <!-- Hall Type -->
        <vee-field name="hall_type_id" v-slot="{ errors, field: { value, ...field } }">
            <div class="mb-6">
                <v-autocomplete v-bind="field" :error-messages="errors" v-model="form.hall_type_id" variant="outlined"
                    :items="hall_types" item-title="name" item-value="id" density="comfortable"
                    prepend-inner-icon="mdi-theater" :placeholder="__('Select Hall Type')" class="rounded-lg"
                    bg-color="surface" hide-details="auto"></v-autocomplete>
            </div>
        </vee-field>

        <!-- Seat Types Section -->
        <div class="mt-6 pt-2 border-t border-gray-200">
            <div class="d-flex justify-space-between align-center mb-4">
                <h3 class="text-h6 font-weight-medium d-flex align-center" style="font-family: Kantumruy Pro;">
                    <v-icon color="primary" class="mr-2">mdi-seat</v-icon>
                    {{ __('Seat Types') }}
                </h3>
                <v-btn color="primary" size="small" @click="showSeatTypeForm ? saveSeatType() : openSeatTypeForm()"
                    prepend-icon="mdi-plus" variant="tonal" class="rounded-lg text-none px-4 py-2">
                    {{ showSeatTypeForm ? __('ADD ANOTHER') : __('Add Seat Types') }}
                </v-btn>
            </div>

            <!-- Inline Seat Type Form (Replacement for Dialog) -->
            <v-expand-transition>
                <v-card v-if="showSeatTypeForm" class="mb-6 rounded-lg border">
                    <v-card-title class="bg-primary text-white py-3 px-4 d-flex align-center">
                        <v-icon color="white" class="mr-2">{{ editedIndex === -1 ? 'mdi-plus-circle' : 'mdi-pencil'
                            }}</v-icon>
                        {{ editedIndex === -1 ? __('Add Seat Types') : __('Edit Seat Type') }}
                    </v-card-title>

                    <v-card-text class="pt-4 px-4">
                        <div class="mb-4">
                            <label class="text-caption text-grey-darken-1 mb-1 block">{{ __('Seat Type') }}</label>
                            <v-autocomplete v-model="editedSeatType.seat_type_id" :items="availableSeatTypes"
                                item-title="name" item-value="id" variant="outlined" hide-details density="comfortable"
                                class="rounded-lg" placeholder="Select a seat type"
                                prepend-inner-icon="mdi-seat"></v-autocomplete>
                        </div>

                        <div class="mb-4">
                            <label class="text-caption text-grey-darken-1 mb-1 block">{{ __('Maximum Amount') }}</label>
                            <v-text-field v-model="editedSeatType.maximum_capacity" type="number" min="1"
                                variant="outlined" hide-details density="comfortable" class="rounded-lg"
                                placeholder="Enter maximum amount" prepend-inner-icon="mdi-counter"></v-text-field>
                        </div>

                        <div class="mb-2">
                            <label class="text-caption text-grey-darken-1 mb-1 block">{{ __('Row Labels') }}</label>
                            <v-select v-model="editedSeatType.rows" :items="availableRows" variant="outlined"
                                hide-details density="comfortable" multiple chips class="rounded-lg"
                                placeholder="Select row labels (optional)"
                                prepend-inner-icon="mdi-format-list-numbered"></v-select>
                        </div>
                    </v-card-text>

                    <v-card-actions class="pa-4 pt-0">
                        <v-spacer></v-spacer>
                        <v-btn variant="text" color="error" class="text-none font-weight-medium me-2"
                            @click="closeSeatTypeForm" rounded="lg">
                            {{ __('CANCEL') }}
                        </v-btn>
                        <v-btn v-if="editedIndex > -1" variant="elevated" color="primary"
                            class="text-none font-weight-medium" @click="saveSeatType" rounded="lg">
                            <v-icon class="mr-1">mdi-check</v-icon>
                            {{ __('UPDATE') }}
                        </v-btn>
                        <v-btn v-else variant="elevated" color="primary" class="text-none font-weight-medium"
                            @click="saveSeatType" rounded="lg">
                            <v-icon class="mr-1">mdi-check</v-icon>
                            {{ __('SAVE') }}
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-expand-transition>

            <!-- Seat Types Table -->
            <v-fade-transition>
                <div v-if="form.hallSeatTypes && form.hallSeatTypes.length > 0"
                    class="rounded-lg border overflow-hidden">
                    <v-table density="comfortable" class="w-100">
                        <thead class="bg-grey-lighten-5">
                            <tr>
                                <th class="text-subtitle-2 font-weight-medium">{{ __('Seat Type') }}</th>
                                <th class="text-subtitle-2 font-weight-medium">{{ __('Maximum Amount') }}</th>
                                <th class="text-center text-subtitle-2 font-weight-medium">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(hallSeatType, index) in form.hallSeatTypes" :key="index"
                                class="hover:bg-grey-lighten-5">
                                <td class="py-3">
                                    <div class="d-flex align-center">
                                        <v-icon color="primary" class="mr-2">mdi-seat-outline</v-icon>
                                        <span class="font-weight-medium">{{ getSeatTypeName(hallSeatType.seat_type_id)
                                            }}</span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-center">
                                        <v-icon color="grey" class="mr-2">mdi-counter</v-icon>
                                        <span>{{ hallSeatType.maximum_capacity }}</span>
                                    </div>
                                </td>
                                <td class="text-center py-3">
                                    <div class="d-flex justify-center">
                                        <v-btn rounded="lg" size="small" color="primary" @click="editSeatType(index)"
                                            class="me-2" variant="tonal">
                                            <v-icon size="small">mdi-pencil</v-icon>
                                        </v-btn>
                                        <v-btn rounded="lg" size="small" color="error" @click="removeSeatType(index)"
                                            variant="tonal">
                                            <v-icon size="small">mdi-delete</v-icon>
                                        </v-btn>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </v-table>
                </div>
            </v-fade-transition>

            <!-- Empty State -->
            <v-alert v-if="!form.hallSeatTypes || form.hallSeatTypes.length === 0" color="info" variant="tonal"
                density="comfortable" class="mt-2 rounded-lg border border-info-lighten-3">
                <div class="d-flex align-center">
                    <v-icon color="info" class="mr-3">mdi-information-outline</v-icon>
                    <span>{{ __('No seat types added yet. Click the button above to add seat types.') }}</span>
                </div>
            </v-alert>
        </div>
    </div>
</template>

<script setup>
    import { __ } from 'matice';
    import { ref, computed } from 'vue';

    const props = defineProps({
        seat_types: {
            type: Array,
            required: true
        },
        hall_types: {
            type: Array,
            required: true
        }
    });

    // Use defineModel for form data with proper typing
    const form = defineModel('form', {
        type: Object,
        required: true,
    });

    // Replace dialog with inline form control
    const showSeatTypeForm = ref(false);
    const editedIndex = ref(-1);
    const editedSeatType = ref({
        seat_type_id: null,
        maximum_capacity: 1,
        rows: []
    });

    // Available rows (A-Z)
    const availableRows = computed(() => {
        return Array.from({ length: 26 }, (_, i) => String.fromCharCode(65 + i));
    });

    // Filter out seat types that have already been added to the hall
    const availableSeatTypes = computed(() => {
        if (!form.value.hallSeatTypes || !props.seat_types) {
            return props.seat_types || [];
        }

        // If we're editing an existing seat type, we need to include it in the available options
        if (editedIndex.value > -1) {
            const currentSeatTypeId = form.value.hallSeatTypes[editedIndex.value]?.seat_type_id;

            // Filter out seat types that are already used except the one being edited
            return props.seat_types.filter(seatType => {
                // Include the currently edited seat type in the options
                if (seatType.id === currentSeatTypeId) {
                    return true;
                }

                // Exclude seat types that are already in use
                return !form.value.hallSeatTypes.some(
                    hallSeatType => hallSeatType.seat_type_id === seatType.id
                );
            });
        }

        // For new seat types, exclude all that are already in use
        return props.seat_types.filter(seatType => {
            return !form.value.hallSeatTypes.some(
                hallSeatType => hallSeatType.seat_type_id === seatType.id
            );
        });
    });

    // Get seat type name by ID
    const getSeatTypeName = (id) => {
        const seatType = props.seat_types.find(type => type.id === id);
        return seatType ? seatType.name : '';
    };

    // Open seat type form instead of dialog
    const openSeatTypeForm = () => {
        editedIndex.value = -1;
        editedSeatType.value = {
            seat_type_id: null,
            maximum_capacity: 1,
            rows: []
        };
        showSeatTypeForm.value = true;
    };

    // Edit seat type
    const editSeatType = (index) => {
        // When editing, we need to show the form and populate it
        editedIndex.value = index;
        editedSeatType.value = { ...form.value.hallSeatTypes[index] };
        showSeatTypeForm.value = true;
    };

    // Remove seat type
    const removeSeatType = (index) => {
        form.value.hallSeatTypes = form.value.hallSeatTypes.filter((_, i) => i !== index);
    };

    // Close seat type form
    const closeSeatTypeForm = () => {
        showSeatTypeForm.value = false;
    };

    // Save seat type
    const saveSeatType = () => {
        // Check if seat type is selected
        if (!editedSeatType.value.seat_type_id) {
            // Use Vuetify snackbar or alert instead of browser alert
            alert(__('Please select a seat type'));
            return;
        }

        // Ensure maximum_capacity is a number and greater than 0
        const maxCapacity = parseInt(editedSeatType.value.maximum_capacity);
        if (isNaN(maxCapacity) || maxCapacity <= 0) {
            alert(__('Maximum capacity must be a positive number'));
            return;
        }

        // Create a new object to ensure value changes are detected
        const seatTypeData = {
            seat_type_id: editedSeatType.value.seat_type_id,
            maximum_capacity: maxCapacity,
            rows: [...(editedSeatType.value.rows || [])]
        };

        if (editedIndex.value > -1) {
            // Update existing
            form.value.hallSeatTypes = form.value.hallSeatTypes.map((item, i) =>
                i === editedIndex.value ? seatTypeData : item
            );
        } else {
            // Add new
            form.value.hallSeatTypes = [...form.value.hallSeatTypes, seatTypeData];
        }

        // Reset the form completely
        editedSeatType.value = {
            seat_type_id: null,
            maximum_capacity: 1,
            rows: []
        };

        // Close the form
        closeSeatTypeForm();
    };
</script>

<style scoped>
    .form-field {
        @apply mb-4;
    }

    .form-label {
        @apply block text-sm font-medium text-gray-700 mb-1;
    }

    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.3s ease;
    }

    .fade-enter-from,
    .fade-leave-to {
        opacity: 0;
    }
</style>
