<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HallSeatTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'seat_type'         => $this->seatType?->name,
            'rows'              => collect($this->hall->seats)
                ->where('seat_type_id', $this->seat_type_id)
                ->pluck('row')
                ->unique()
                ->values()
                ->toArray(),
        ];
    }
}
