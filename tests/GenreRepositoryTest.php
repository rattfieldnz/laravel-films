<?php

use App\Models\Genre;
use App\Repositories\GenreRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GenreRepositoryTest extends TestCase
{
    use MakeGenreTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var GenreRepository
     */
    protected $genreRepo;

    public function setUp()
    {
        parent::setUp();
        $this->genreRepo = App::make(GenreRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateGenre()
    {
        $genre = $this->fakeGenreData();
        $createdGenre = $this->genreRepo->create($genre);
        $createdGenre = $createdGenre->toArray();
        $this->assertArrayHasKey('id', $createdGenre);
        $this->assertNotNull($createdGenre['id'], 'Created Genre must have id specified');
        $this->assertNotNull(Genre::find($createdGenre['id']), 'Genre with given id must be in DB');
        $this->assertModelData($genre, $createdGenre);
    }

    /**
     * @test read
     */
    public function testReadGenre()
    {
        $genre = $this->makeGenre();
        $dbGenre = $this->genreRepo->find($genre->id);
        $dbGenre = $dbGenre->toArray();
        $this->assertModelData($genre->toArray(), $dbGenre);
    }

    /**
     * @test update
     */
    public function testUpdateGenre()
    {
        $genre = $this->makeGenre();
        $fakeGenre = $this->fakeGenreData();
        $updatedGenre = $this->genreRepo->update($fakeGenre, $genre->id);
        $this->assertModelData($fakeGenre, $updatedGenre->toArray());
        $dbGenre = $this->genreRepo->find($genre->id);
        $this->assertModelData($fakeGenre, $dbGenre->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteGenre()
    {
        $genre = $this->makeGenre();
        $resp = $this->genreRepo->delete($genre->id);
        $this->assertTrue($resp);
        $this->assertNull(Genre::find($genre->id), 'Genre should not exist in DB');
    }
}
