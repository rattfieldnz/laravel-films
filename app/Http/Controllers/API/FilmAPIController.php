<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFilmAPIRequest;
use App\Http\Requests\API\UpdateFilmAPIRequest;
use App\Models\Film;
use App\Repositories\FilmRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Response;

/**
 * Class FilmController
 * @package App\Http\Controllers\API
 */

class FilmAPIController extends AppBaseController
{
    /** @var  FilmRepository */
    private $filmRepository;

    public function __construct(FilmRepository $filmRepo)
    {
        $this->filmRepository = $filmRepo;
        $this->middleware('create_fresh_api_token:api');
    }

    /**
     * Display a listing of the Film.
     * GET|HEAD /films
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        try {
            $this->filmRepository->pushCriteria(new RequestCriteria($request));
            $films = $this->filmRepository->all();

            return $this->sendResponse($films->toArray(), 'Films retrieved successfully');
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage(), 500);
        } catch (\Exception $e){
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created Film in storage.
     * POST /films
     *
     * @param CreateFilmAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFilmAPIRequest $request)
    {
        try{
            $input = $request->all();

            $films = $this->filmRepository->create($input);

            return $this->sendResponse($films->toArray(), 'Film saved successfully');
        } catch(\Exception $e){
            $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified Film.
     * GET|HEAD /films/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try{
            /** @var Film $film */
            $film = $this->filmRepository->findWithoutFail($id);

            if (empty($film)) {
                return $this->sendError('Film not found');
            }

            return $this->sendResponse($film->toArray(), 'Film retrieved successfully');
        } catch(\Exception $e){
            $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Update the specified Film in storage.
     * PUT/PATCH /films/{id}
     *
     * @param  int $id
     * @param UpdateFilmAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFilmAPIRequest $request)
    {
        try{
            $input = $request->all();

            /** @var Film $film */
            $film = $this->filmRepository->findWithoutFail($id);

            if (empty($film)) {
                return $this->sendError('Film not found');
            }

            $film = $this->filmRepository->update($input, $id);

            return $this->sendResponse($film->toArray(), 'Film updated successfully');
        } catch(\Exception $e){
            $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified Film from storage.
     * DELETE /films/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{

            /** @var Film $film */
            $film = $this->filmRepository->findWithoutFail($id);

            if (empty($film)) {
                return $this->sendError('Film not found');
            }

            $film->delete();

            return $this->sendResponse($id, 'Film deleted successfully');
        } catch(\Exception $e){
            $this->sendError($e->getMessage(), 500);
        }
    }
}
