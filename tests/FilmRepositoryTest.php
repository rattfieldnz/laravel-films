<?php

use App\Models\Film;
use App\Repositories\FilmRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FilmRepositoryTest extends TestCase
{
    use MakeFilmTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var FilmRepository
     */
    protected $filmRepo;

    public function setUp()
    {
        parent::setUp();
        $this->filmRepo = App::make(FilmRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateFilm()
    {
        $film = $this->fakeFilmData();
        $createdFilm = $this->filmRepo->create($film);
        $createdFilm = $createdFilm->toArray();
        $this->assertArrayHasKey('id', $createdFilm);
        $this->assertNotNull($createdFilm['id'], 'Created Film must have id specified');
        $this->assertNotNull(Film::find($createdFilm['id']), 'Film with given id must be in DB');
        $this->assertModelData($film, $createdFilm);
    }

    /**
     * @test read
     */
    public function testReadFilm()
    {
        $film = $this->makeFilm();
        $dbFilm = $this->filmRepo->find($film->id);
        $dbFilm = $dbFilm->toArray();
        $this->assertModelData($film->toArray(), $dbFilm);
    }

    /**
     * @test update
     */
    public function testUpdateFilm()
    {
        $film = $this->makeFilm();
        $fakeFilm = $this->fakeFilmData();
        $updatedFilm = $this->filmRepo->update($fakeFilm, $film->id);
        $this->assertModelData($fakeFilm, $updatedFilm->toArray());
        $dbFilm = $this->filmRepo->find($film->id);
        $this->assertModelData($fakeFilm, $dbFilm->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteFilm()
    {
        $film = $this->makeFilm();
        $resp = $this->filmRepo->delete($film->id);
        $this->assertTrue($resp);
        $this->assertNull(Film::find($film->id), 'Film should not exist in DB');
    }
}
