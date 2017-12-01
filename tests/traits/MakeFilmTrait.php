<?php

use Faker\Factory as Faker;
use App\Models\Film;
use App\Repositories\FilmRepository;

trait MakeFilmTrait
{
    /**
     * Create fake instance of Film and save it in database
     *
     * @param array $filmFields
     * @return Film
     */
    public function makeFilm($filmFields = [])
    {
        /** @var FilmRepository $filmRepo */
        $filmRepo = App::make(FilmRepository::class);
        $theme = $this->fakeFilmData($filmFields);
        return $filmRepo->create($theme);
    }

    /**
     * Get fake instance of Film
     *
     * @param array $filmFields
     * @return Film
     */
    public function fakeFilm($filmFields = [])
    {
        return new Film($this->fakeFilmData($filmFields));
    }

    /**
     * Get fake data of Film
     *
     * @param array $postFields
     * @return array
     */
    public function fakeFilmData($filmFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'slug' => $fake->word,
            'description' => $fake->text,
            'release_date' => $fake->word,
            'rating' => $fake->word,
            'ticket_price' => $fake->word,
            'country' => $fake->word,
            'photo_url' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $filmFields);
    }
}
