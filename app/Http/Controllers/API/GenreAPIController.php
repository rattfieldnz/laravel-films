<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateGenreAPIRequest;
use App\Http\Requests\API\UpdateGenreAPIRequest;
use App\Models\Genre;
use App\Repositories\GenreRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Response;

/**
 * Class GenreController
 * @package App\Http\Controllers\API
 */

class GenreAPIController extends AppBaseController
{
    /** @var  GenreRepository */
    private $genreRepository;

    public function __construct(GenreRepository $genreRepo)
    {
        $this->genreRepository = $genreRepo;
    }

    /**
     * Display a listing of the Genre.
     * GET|HEAD /genres
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        try {
            $this->genreRepository->pushCriteria(new RequestCriteria($request));
            $this->genreRepository->pushCriteria(new LimitOffsetCriteria($request));
            $genres = $this->genreRepository->all();

            return $this->sendResponse($genres->toArray(), 'Genres retrieved successfully');
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage(), 500);
        } catch (\Exception $e){
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created Genre in storage.
     * POST /genres
     *
     * @param CreateGenreAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateGenreAPIRequest $request)
    {
        try{
            $input = $request->all();

            $genres = $this->genreRepository->create($input);

            return $this->sendResponse($genres->toArray(), 'Genre saved successfully');
        } catch (\Exception $e){
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified Genre.
     * GET|HEAD /genres/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try{
            /** @var Genre $genre */
            $genre = $this->genreRepository->findWithoutFail($id);

            if (empty($genre)) {
                return $this->sendError('Genre not found');
            }

            return $this->sendResponse($genre->toArray(), 'Genre retrieved successfully');

        } catch (\Exception $e){
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Update the specified Genre in storage.
     * PUT/PATCH /genres/{id}
     *
     * @param  int $id
     * @param UpdateGenreAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGenreAPIRequest $request)
    {
        try{
            $input = $request->all();

            /** @var Genre $genre */
            $genre = $this->genreRepository->findWithoutFail($id);

            if (empty($genre)) {
                return $this->sendError('Genre not found');
            }

            $genre = $this->genreRepository->update($input, $id);

            return $this->sendResponse($genre->toArray(), 'Genre updated successfully');
        } catch (\Exception $e){
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified Genre from storage.
     * DELETE /genres/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{
            /** @var Genre $genre */
            $genre = $this->genreRepository->findWithoutFail($id);

            if (empty($genre)) {
                return $this->sendError('Genre not found');
            }

            $genre->delete();

            return $this->sendResponse($id, 'Genre deleted successfully');
        } catch (\Exception $e){
            return $this->sendError($e->getMessage(), 500);
        }
    }
}
