<?php
namespace App\Service;

use App\Model\Movie;

class MovieService
{
    public static function save(array $data): Movie
    {
        $movie = Movie::fromArray($data['movie']);
        $movie->save();

        self::saveGenres($movie, $data['genres'] ?? []);
        self::saveAvailability($movie, $data['availability'] ?? []);

        return $movie;
    }

    private static function saveGenres(Movie $movie, array $genreIds): void
    {
        foreach ($genreIds as $genreId) {
            $movie->addGenre((int) $genreId);
        }
    }

    private static function saveAvailability(Movie $movie, array $availabilityIds): void
    {
        foreach ($availabilityIds as $availabilityId) {
            $movie->addAvailability((int) $availabilityId);
        }
    }
}
