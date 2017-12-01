<?php

use Faker\Factory as Faker;
use App\Models\Genre;
use App\Repositories\GenreRepository;

trait MakeGenreTrait
{
    /**
     * Create fake instance of Genre and save it in database
     *
     * @param array $genreFields
     * @return Genre
     */
    public function makeGenre($genreFields = [])
    {
        /** @var GenreRepository $genreRepo */
        $genreRepo = App::make(GenreRepository::class);
        $theme = $this->fakeGenreData($genreFields);
        return $genreRepo->create($theme);
    }

    /**
     * Get fake instance of Genre
     *
     * @param array $genreFields
     * @return Genre
     */
    public function fakeGenre($genreFields = [])
    {
        return new Genre($this->fakeGenreData($genreFields));
    }

    /**
     * Get fake data of Genre
     *
     * @param array $postFields
     * @return array
     */
    public function fakeGenreData($genreFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $genreFields);
    }
}
