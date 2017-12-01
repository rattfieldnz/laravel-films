<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GenreApiTest extends TestCase
{
    use MakeGenreTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateGenre()
    {
        $genre = $this->fakeGenreData();
        $this->json('POST', '/api/v1/genres', $genre);

        $this->assertApiResponse($genre);
    }

    /**
     * @test
     */
    public function testReadGenre()
    {
        $genre = $this->makeGenre();
        $this->json('GET', '/api/v1/genres/'.$genre->id);

        $this->assertApiResponse($genre->toArray());
    }

    /**
     * @test
     */
    public function testUpdateGenre()
    {
        $genre = $this->makeGenre();
        $editedGenre = $this->fakeGenreData();

        $this->json('PUT', '/api/v1/genres/'.$genre->id, $editedGenre);

        $this->assertApiResponse($editedGenre);
    }

    /**
     * @test
     */
    public function testDeleteGenre()
    {
        $genre = $this->makeGenre();
        $this->json('DELETE', '/api/v1/genres/'.$genre->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/genres/'.$genre->id);

        $this->assertResponseStatus(404);
    }
}
