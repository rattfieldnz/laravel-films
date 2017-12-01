<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FilmApiTest extends TestCase
{
    use MakeFilmTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateFilm()
    {
        $film = $this->fakeFilmData();
        $this->json('POST', '/api/v1/films', $film);

        $this->assertApiResponse($film);
    }

    /**
     * @test
     */
    public function testReadFilm()
    {
        $film = $this->makeFilm();
        $this->json('GET', '/api/v1/films/'.$film->id);

        $this->assertApiResponse($film->toArray());
    }

    /**
     * @test
     */
    public function testUpdateFilm()
    {
        $film = $this->makeFilm();
        $editedFilm = $this->fakeFilmData();

        $this->json('PUT', '/api/v1/films/'.$film->id, $editedFilm);

        $this->assertApiResponse($editedFilm);
    }

    /**
     * @test
     */
    public function testDeleteFilm()
    {
        $film = $this->makeFilm();
        $this->json('DELETE', '/api/v1/films/'.$film->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/films/'.$film->id);

        $this->assertResponseStatus(404);
    }
}
