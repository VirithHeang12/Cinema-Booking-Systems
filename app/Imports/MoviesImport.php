<?php

namespace App\Imports;

use App\Models\Classification;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class MoviesImport implements ToCollection, WithHeadingRow
{
    /**
     * Import movies from an Excel file.
     *
     * @param Collection $rows
     *
     * @return void
     */
    public function collection(Collection $rows)
    {
        $placeholderThumbnailUrl =  resource_path('/assets/images/placeholder.jpg');

        $randomName = Str::random(40) . '.' . pathinfo($placeholderThumbnailUrl, PATHINFO_EXTENSION);

        $storagePath = Storage::disk('local')->putFileAs('movies', new \Illuminate\Http\File($placeholderThumbnailUrl), $randomName);

        DB::beginTransaction();

        try {
            foreach ($rows as $row) {
                $movie = Movie::updateOrCreate([
                    'title'                     => $row['title'],
                    'trailer_url'               => $row['trailer_url'],
                    'thumbnail_url'             => $storagePath,
                ], [
                    'description'               => $row['description'],
                    'release_date'              => Carbon::createFromDate(1899, 12, 30)->addDays($row['release_date']),
                    'duration'                  => $row['duration'],
                    'rating'                    => $row['rating'],
                    'country_id'                => Country::where('name', $row['country'])->first()?->id,
                    'classification_id'         => Classification::where('name', $row['classification'])->first()?->id,
                    'spoken_language_id'        => Language::where('name', $row['spoken_language'])->first()?->id,
                ]);

                $movie->movieGenres()->delete();
                $movie->movieSubtitles()->delete();

                $genre_ids      = Genre::whereIn('name', explode(',', $row['genres']))->pluck('id');
                $subtitle_ids   = Language::whereIn('name', explode(',', $row['subtitles']))->pluck('id');

                foreach ($genre_ids as $genre_id) {
                    $movie->movieGenres()->create([
                        'movie_id'      => $movie->id,
                        'genre_id'      => $genre_id,
                    ]);
                }

                foreach ($subtitle_ids as $subtitle_id) {
                    $movie->movieSubtitles()->create([
                        'movie_id'      => $movie->id,
                        'language_id'   => $subtitle_id,
                    ]);
                }

            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
