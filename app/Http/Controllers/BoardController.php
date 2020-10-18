<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBoardRequest;
use App\Http\Requests\EditBoardRequest;
use App\Http\Resources\BoardResource;
use App\Models\Board;
use App\Traits\BoardTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    use BoardTrait;

    /**
     * @OA\Get(
     *     path="/api/board",
     *     operationId="get-all-user-boards",
     *     summary="Get all boards that belongs to authorized user.",
     *     tags={"all_boards"},
     *     description="Get all boards that belongs to authorized user",
     *     @OA\Response(
     *       response="200",
     *       description="Successful",
     *       @OA\JsonContent(
     *          @OA\Property(
     *              property="data",
     *              type="array",
     *                @OA\Items(ref="#/components/schemas/BoardResource")
     *          ),
     *       )
     *     )
     * )
     *
     * Get all user boards
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function userBoards(Request $request)
    {
        return response()->json([
            'boards' => BoardResource::collection($this->getUserBoards($request->user()->_id))
        ], 200);
    }

    /**
     * @OA\POST(
     *     path="/api/board/create",
     *     operationId="create-board",
     *     summary="Create board.",
     *     tags={"create_board"},
     *     description="Create new board",
     *     @OA\Parameter(
     *          parameter = "title",
     *          name="title",
     *          description="Board title",
     *          in="path"
     *     ),
     *     @OA\Response(
     *       response="200",
     *       description="Successful",
     *       @OA\JsonContent(
     *          @OA\Property(
     *              property="data",
     *              type="array",
     *                @OA\Items(ref="#/components/schemas/BoardResource")
     *          ),
     *       )
     *     ),
     *     @OA\SecurityScheme(
     *          securityScheme="bearer",
     *          type="Bearer",
     *          in="header",
     *          name="Authorization"
     *      )
     * )
     *
     * Create new board
     *
     * @param CreateBoardRequest $request
     * @return JsonResponse
     */
    public function create(CreateBoardRequest $request)
    {
        if ($board = $this->createBoard($request->input('title'), $request->user()->_id)) {
            return response()->json(['board' => BoardResource::make($board)], 200);
        }

        return response()->json(['message' => 'Can\'t create board'], 400);
    }

    /**
     * @OA\GET(
     *     path="/api/board/{board}",
     *     operationId="return-board",
     *     summary="Return single board.",
     *     tags={"return_board"},
     *     description="Return single board by id",
     *     @OA\Parameter(
     *          parameter = "board",
     *          name="board",
     *          description="Id of board",
     *          in="path"
     *     ),
     *     @OA\Response(
     *       response="200",
     *       description="Successful",
     *       @OA\JsonContent(
     *          @OA\Property(
     *              property="data",
     *              type="array",
     *                @OA\Items(ref="#/components/schemas/BoardResource")
     *          ),
     *       )
     *     )
     * )
     *
     * Returns single board by id
     *
     * @param Board $board
     * @return JsonResponse
     */
    public function show(Board $board)
    {
        return response()->json(['board' => BoardResource::make($board)], 200);
    }

    /**
     * @OA\PATCH(
     *     path="/api/board/{board}",
     *     operationId="edit-board",
     *     summary="Edit board.",
     *     tags={"edit_board"},
     *     description="Edit board.",
     *     @OA\Parameter(
     *          parameter = "board",
     *          name="board",
     *          description="Id of board",
     *          in="path"
     *     ),
     *    @OA\Parameter(
     *          parameter = "title",
     *          name="title",
     *          description="New board title",
     *          in="path"
     *     ),
     *     @OA\Response(
     *       response="200",
     *       description="Successful",
     *       @OA\JsonContent(
     *          @OA\Property(
     *              property="data",
     *              type="array",
     *                @OA\Items(ref="#/components/schemas/BoardResource")
     *          ),
     *       )
     *     )
     * )
     *
     * Returns single board by id
     * @param Board $board
     * @param EditBoardRequest $request
     * @return JsonResponse
     */
    public function edit(Board $board, EditBoardRequest $request)
    {
        if (\Gate::inspect('delete', $board)->allowed() && $board->update($request->all())) {
            return response()->json([BoardResource::make($board)], 200);
        }

        return response()->json(['message' => 'Access is forbidden'], 420);
    }

    /**
     * @OA\DELETE(
     *     path="/api/board/{board}",
     *     operationId="delete-board",
     *     summary="Delete board.",
     *     tags={"delete_board"},
     *     description="Delete board.",
     *     @OA\Parameter(
     *          parameter="board",
     *          name="board",
     *          description="Id of board",
     *          in="path"
     *     ),
     *     @OA\Response(
     *       response="200",
     *       description="Successful",
     *       @OA\JsonContent(
     *          @OA\Property(
     *              property="success",
     *              type="boolean"
     *          ),
     *          @OA\Property(
     *              property="message",
     *              type="string"
     *          ),
     *       )
     *     )
     * )
     *
     * @param Board $board
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(Board $board)
    {
        if (\Gate::inspect('delete', $board)->allowed() && $board->delete()) {
            return response()->json(['success' => true, 'message' => 'Board was deleted successfully'], 200);
        }

        return response()->json(['success' => false, 'message' => 'Access is forbidden'], 420);
    }
}
