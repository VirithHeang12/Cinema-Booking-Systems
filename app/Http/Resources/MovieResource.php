<?php

namespace App\Http\Resources;

use App\Http\Resources\Api\GenreResource;
use App\Http\Resources\Api\LanguageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;

class MovieResource extends JsonResource
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
            'title'             => $this->title,
            'description'       => $this->description,
            'release_date'      => $this->release_date,
            'duration'          => $this->duration,
            'trailer_url'       => $this->trailer_url,
            'thumbnail_url'    => $this->thumbnail_url,
            'classification'    => $this->classification?->name,
            'country'           => $this->country?->name,
            'language'          => $this->language?->name,
            'genres'            => $this->movieGenres,
            'subtitles'         => $this->movieSubtitles,
        ];
    }
}
