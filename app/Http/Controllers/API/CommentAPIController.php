<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCommentAPIRequest;
use App\Http\Requests\API\UpdateCommentAPIRequest;
use App\Models\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CommentController
 * @package App\Http\Controllers\API
 */

class CommentAPIController extends AppBaseController
{
    /** @var  CommentRepository */
    private $commentRepository;

    public function __construct(CommentRepository $commentRepo)
    {
        $this->commentRepository = $commentRepo;
    }

    /**
     * Store a newly created Comment in storage.
     * POST /comments
     *
     * @param CreateCommentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCommentAPIRequest $request)
    {
        try{
            $input = $request->all();

            $comments = $this->commentRepository->create($input);

            return $this->sendResponse($comments->toArray(), 'Comment saved successfully');
        } catch(\Exception $e){
            $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified Comment.
     * GET|HEAD /comments/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try{
            /** @var Comment $comment */
            $comment = $this->commentRepository->findWithoutFail($id);

            if (empty($comment)) {
                return $this->sendError('Comment not found');
            }

            return $this->sendResponse($comment->toArray(), 'Comment retrieved successfully');
        } catch(\Exception $e){
            $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Update the specified Comment in storage.
     * PUT/PATCH /comments/{id}
     *
     * @param  int $id
     * @param UpdateCommentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCommentAPIRequest $request)
    {
        try{
            $input = $request->all();

            /** @var Comment $comment */
            $comment = $this->commentRepository->findWithoutFail($id);

            if (empty($comment)) {
                return $this->sendError('Comment not found');
            }

            $comment = $this->commentRepository->update($input, $id);

            return $this->sendResponse($comment->toArray(), 'Comment updated successfully');
        } catch(\Exception $e){
            $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified Comment from storage.
     * DELETE /comments/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{
            /** @var Comment $comment */
            $comment = $this->commentRepository->findWithoutFail($id);

            if (empty($comment)) {
                return $this->sendError('Comment not found');
            }

            $comment->delete();

            return $this->sendResponse($id, 'Comment deleted successfully');
        } catch(\Exception $e){
            $this->sendError($e->getMessage(), 500);
        }
    }
}
