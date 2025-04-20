<template>
    <v-container fluid>
        <v-row dense>
            <v-col :cols="12" :md="5">
                <v-row dense>
                    <v-col :cols="12" :md="12">
                        <v-row>
                            <v-col>
                                <v-btn color="primary" variant="outlined" class="mb-4" prepend-icon="mdi-arrow-left"
                                    rounded="lg" @click="backCallback">
                                    {{ __('Back') }}
                                </v-btn>
                            </v-col>
                        </v-row>
                        <h2 class="form-title">{{ hall.data.name }}</h2>
                    </v-col>
                    <v-col :cols="12" :md="12">
                        <div class="form-content !font-medium">
                            <div class="details-section">
                                <div class="field-row">
                                    <div class="field-label">{{ __('Description') }}</div>
                                    <div>{{ hall.data.description }}</div>
                                </div>

                                <div class="columns">
                                    <div class="field-column">
                                        <div class="field-label">{{ __('Hall Type') }}</div>
                                        <div class="field-value duration-value">
                                            <v-icon size="small">mdi-seat</v-icon>
                                            {{ hall.data.hall_type }}
                                        </div>
                                    </div>
                                    <div class="field-column">
                                        <div class="field-label">{{ __('Maximum Seats Per Row') }}</div>
                                        <div class="field-value duration-value">
                                            <v-icon size="small">mdi-seat</v-icon>
                                            {{ hall.data.maximum_seats_per_row }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </v-col>
                </v-row>
            </v-col>
            <v-col :cols="12" :md="7">
                <data-table-server :showNo="true" :title="__('Seat Types')" :createButtonText="__('Add Seat Type')"
                    :serverItems="serverItems" :items-length="totalItems" :headers="headers" :loading="loading"
                    :itemsPerPage="itemsPerPage" item-value="id" @update:options="loadItems" @edit="editCallback"
                    @delete="deleteCallback" @create="createCallback"
                    :emptyStateText="__('No seat types found in the database')" :emptyStateAction="true"
                    :emptyStateActionText="__('Add First Seat Type')" @empty-action="createCallback"
                    buttonVariant="outlined" :editTooltip="__('Edit Seat Type Information')"
                    :deleteTooltip="__('Delete this Seat Type')" titleClass="text-2xl font-bold text-primary mb-4"
                    :hasFilter="false" tableClasses="seat-type-data-table rounded-lg" iconSize="small"
                    :deleteConfirmText="__('Are you sure you want to delete this seat type? This action cannot be undone.')"
                    toolbarColor="white" :showSelect="false" :hasView="false" :hasImport="false" :hasExport="false">
                    <template v-slot:[`item.rows`]="{ item }">
                        <template v-if="item.rows.length > 0">
                            <v-chip color="secondary" v-for="row in item.rows" :key="row">
                                {{ row }}
                            </v-chip>
                        </template>
                        <template v-else>
                            <span>N/A</span>
                        </template>
                    </template>
                </data-table-server>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup>
    import { __ } from "matice";
    import { ref, computed } from "vue";
    import { route } from "ziggy-js";
    import { router } from "@inertiajs/vue3";
    import { visitModal } from "@inertiaui/modal-vue";

    const props = defineProps({
        hall: {
            type: Object,
            required: true,
        },
        seat_types: {
            type: Object,
            required: true,
        },
    });

    // State variables
    const loading = ref(false);
    const page = ref(1);
    const sortBy = ref([]);

    // Computed properties
    const serverItems = computed(() => {
        return props.seat_types.data;
    });

    const totalItems = computed(() => {
        return props.seat_types?.total || 0;
    });

    const itemsPerPage = computed(() => {
        return props.seat_types.per_page;
    });

    // Table headers definition
    const headers = [
        {
            title: __("Seat Type"),
            align: "start",
            sortable: false,
            key: "seat_type",
            width: "250px",
        },
        {
            title: __("Rows"),
            align: "start",
            sortable: false,
            key: "rows",
        },
    ];

    /**
     * Load items from the server
     *
     * @param options
     *
     * @return void
     */
    function loadItems(options) {
        loading.value = true;
        page.value = options.page;
        sortBy.value = options.sortBy;

        let sortKeyWithDirection =
            options.sortBy.length > 0 ? options.sortBy[0].key : null;

        if (sortKeyWithDirection) {
            sortKeyWithDirection =
                options.sortBy[0].order === "asc"
                    ? sortKeyWithDirection
                    : "-" + sortKeyWithDirection;
        }

        router.reload({
            data: {
                page: options.page,
                itemsPerPage: options.itemsPerPage,
                sort: sortKeyWithDirection,
            },
            preserveState: true,
            only: ["seat_types"],
            onSuccess: () => {
                loading.value = false;
            },
            onError: () => {
                loading.value = false;
                notify("Failed to load data", "error");
            },
        });
    }

    /**
     * Open the create seat type slideover
     *
     * @return void
     */
    const createCallback = () => {
        visitModal(route('dashboard.halls.seat_types.create', {
            hall: props.hall.data.id,
        }));
    };

    /**
     * Open the edit seat type slideover
     *
     * @param item
     *
     * @return void
     */
    const editCallback = (item) => {
        visitModal(route('dashboard.halls.seat_types.edit', {
            hall: props.hall.data.id,
            seat_type: item.id,
        }));
    };

    /**
     * Show the delete modal
     *
     * @param item
     *
     * @return void
     */
    const deleteCallback = (item) => {
        visitModal(route('dashboard.halls.seat_types.delete', {
            hall: props.hall.data.id,
            seat_type: item.id,
        }), {
            config: {
                slideover: false,
                closeExplicitly: true
            }
        });
    };

    /**
     * Go back to the previous page
     *
     * @return void
     */
    const backCallback = () => {
        router.visit(route('dashboard.halls.index'), {
            preserveState: true,
            method: 'get',
        });
    };
</script>

<style scoped>
    .details-section {
        border-bottom: 1px solid #e0e0e0;
    }

    .details-section:last-child {
        border-bottom: none;
    }

    /* column layout */
    .columns {
        display: flex;
        gap: 24px;
        margin-bottom: 16px;
    }

    .field-column {
        flex: 1;
    }

    .icon-launch,
    .icon-play-circle {
        cursor: pointer;
        color: #1976d2;
    }


    /* Tags styling */
    .tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .subtitle-tag {
        background-color: #e0f2f1;
        color: #00796b;
        padding: 4px 12px;
        border-radius: 16px;
        font-size: 14px;
    }


    /* Trailer styling */
    .trailer-container {
        margin-top: 8px;
        width: 100%;
        border-radius: 4px;
        overflow: hidden;
    }

    .trailer-placeholder {
        margin-top: 8px;
        height: 160px;
        background-color: #f5f5f5;
        border-radius: 4px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    /* Thumbnail styling */
    .thumbnail-image {
        max-width: 100%;
        max-height: 200px;
        border-radius: 4px;
        margin-top: 8px;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .columns {
            flex-direction: column;
            gap: 16px;
        }

        .movie-details-container {
            max-width: 100%;
        }
    }
</style>
