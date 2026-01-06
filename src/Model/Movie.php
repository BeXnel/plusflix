<?php
namespace App\Model;

use App\Service\Database;

class Movie
{
    private ?int $id = null;
    private ?string $title = null;
    private ?int $year = null;
    private ?string $director = null;
    private ?string $description = null;
    private ?float $duration = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Movie
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): Movie
    {
        $this->title = $title;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): Movie
    {
        $this->year = $year;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(?string $director): Movie
    {
        $this->director = $director;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Movie
    {
        $this->description = $description;

        return $this;
    }

    public function getDuration(): ?float
    {
        return $this->duration;
    }

    public function setDuration(?float $duration): Movie
    {
        $this->duration = $duration;

        return $this;
    }

    public static function fromArray($array): Movie
    {
        $movie = new self();
        $movie->fill($array);

        return $movie;
    }

    public function fill($array): Movie
    {
        if (isset($array['id']) && ! $this->getId()) {
            $this->setId($array['id']);
        }
        if (isset($array['title'])) {
            $this->setTitle($array['title']);
        }
        if (isset($array['year'])) {
            $this->setYear($array['year']);
        }
        if (isset($array['director'])) {
            $this->setDirector($array['director']);
        }
        if (isset($array['description'])) {
            $this->setDescription($array['description']);
        }
        if (isset($array['duration'])) {
            $this->setDuration($array['duration']);
        }

        return $this;
    }

    /**
     * @return Movie[]
     */
    public static function findAll(): array
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM movies';
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $movies = [];
        $moviesArray = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($moviesArray as $movieArray) {
            $movies[] = self::fromArray($movieArray);
        }

        return $movies;
    }

    public static function find($id): ?Movie
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM movies WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->execute([':id' => $id]);

        $movieArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (! $movieArray) {
            return null;
        }
        $movie = Movie::fromArray($movieArray);

        return $movie;
    }

    public static function search(string $searchTerm): array
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM movies
                WHERE title LIKE :searchTerm ESCAPE \'!\'
                   OR director LIKE :searchTerm ESCAPE \'!\'
                   OR description LIKE :searchTerm ESCAPE \'!\'';
        $statement = $pdo->prepare($sql);

        $escapedSearchTerm = self::escapeLikeSpecialChars($searchTerm);

        $statement->execute(['searchTerm' => '%' . $escapedSearchTerm . '%']);
        $movies = [];
        $moviesArray = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($moviesArray as $movieArray) {
            $movies[] = self::fromArray($movieArray);
        }
        return $movies;
    }

    private static function escapeLikeSpecialChars(string $term): string
    {
        return str_replace(['!', '%', '_'], ['!!', '!%', '!_'], $term);
    }

    public function save(): void
    {
        $pdo = Database::getPDO();
        if (! $this->getId()) {
            $sql = "INSERT INTO movies (title, year, director, description, duration) VALUES (:title, :year, :director, :description, :duration)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':title' => $this->getTitle(),
                ':year' => $this->getYear(),
                ':director' => $this->getDirector(),
                ':description' => $this->getDescription(),
                ':duration' => $this->getDuration(),
            ]);

            $this->setId($pdo->lastInsertId());
        } else {
            $sql = "UPDATE movies SET title = :title, year = :year, director = :director, description = :description, duration = :duration WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':title' => $this->getTitle(),
                ':year' => $this->getYear(),
                ':director' => $this->getDirector(),
                ':description' => $this->getDescription(),
                ':duration' => $this->getDuration(),
                ':id' => $this->getId(),
            ]);
        }
    }

    public function delete(): void
    {
        $pdo = Database::getPDO();
        $sql = "DELETE FROM movies WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':id' => $this->getId(),
        ]);

        $this->setId(null);
        $this->setTitle(null);
        $this->setYear(null);
        $this->setDirector(null);
        $this->setDescription(null);
        $this->setDuration(null);
    }

    public function getGenres(): array {
        $pdo = Database::getPDO();
        $sql = 'SELECT g.* FROM genres g
                JOIN movie_genres mg ON g.id = mg.genre_id
                WHERE mg.movie_id = :movie_id';
        $statement = $pdo->prepare($sql);
        $statement->execute(['movie_id' => $this->getId()]);

        $genres = [];
        foreach ($statement->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            $genres[] = Genre::fromArray($row);
        }
        return $genres;
    }

    public function addGenre(int $genreId): void
    {
        $pdo = Database::getPDO();
        $sql = 'INSERT IGNORE INTO movie_genres (movie_id, genre_id) VALUES (:movie_id, :genre_id)';
        $statement = $pdo->prepare($sql);
        $statement->execute([':movie_id' => $this->getId(), ':genre_id' => $genreId]);
    }

    public function removeGenre(int $genreId): void
    {
        $pdo = Database::getPDO();
        $sql = 'DELETE FROM movie_genres WHERE movie_id = :movie_id AND genre_id = :genre_id';
        $statement = $pdo->prepare($sql);
        $statement->execute([':movie_id' => $this->getId(), ':genre_id' => $genreId]);
    }

    public function addAvailability(int $platformId): void
    {
        $pdo = Database::getPDO();
        $sql = 'INSERT IGNORE INTO availability (movie_id, platform_id) VALUES (:movie_id, :platform_id)';
        $statement = $pdo->prepare($sql);
        $statement->execute([':movie_id' => $this->getId(), ':platform_id' => $platformId]);
    }

    public function removeAvailability(int $platformId): void
    {
        $pdo = Database::getPDO();
        $sql = 'DELETE FROM availability WHERE movie_id = :movie_id AND platform_id = :platform_id';
        $statement = $pdo->prepare($sql);
        $statement->execute([':movie_id' => $this->getId(), ':platform_id' => $platformId]);
    }

    /**
     * @return Review[]
     */
    public function getReviews(): array
    {
       return Review::findByMovieId($this->getId());
    }

    public function addReview(int $rating, ?string $comment = null): Review
    {
        $review = new Review();
        $review->setMovieId($this->getId())
                ->setRating($rating)
                ->setComment($comment);
        $review->save();

        return $review;
    }

    public function removeReview(int $reviewId): void
    {
        $review = Review::find($reviewId);
        if ($review && $review->getMovieId() === $this->getId()) {
            $review->delete();
        }
    }

    public function clearReviews(): void
    {
        $pdo = Database::getPDO();
        $sql = 'DELETE FROM reviews WHERE movie_id = :movie_id';
        $statement = $pdo->prepare($sql);
        $statement->execute([':movie_id' => $this->getId()]);
    }

    public function getAverageRating(): ?float
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT AVG(rating) as avg_rating FROM reviews WHERE movie_id = :movie_id';
        $statement = $pdo->prepare($sql);
        $statement->execute([':movie_id' => $this->getId()]);

        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        return $result['avg_rating'] ? (float) $result['avg_rating'] : null;
    }
}
