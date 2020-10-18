<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBoardRequest;
use App\Http\Requests\EditBoardRequest;
use App\Http\Resources\BoardResource;
use App\Models\Board;
use App\Traits\BoardTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BoardController extends Controller
{
    use BoardTrait;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function all(Request $request)
    {
        return response()->json([
            'boards' => BoardResource::collection($this->getUserBoards($request->user()->_id))
        ], 200);
    }

    /**
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
     *
     * @param Board $board
     * @return JsonResponse
     */
    public function show(Board $board)
    {
        return response()->json(['board' => BoardResource::make($board)], 200);
    }

    /**
     *
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
     * Remove the specified resource from storage.
     *
     * @param Board $board
     * @return JsonResponse
     */
    public function delete(Board $board)
    {
        if (\Gate::inspect('delete', $board)->allowed() && $board->delete()) {
            return response()->json(['success' => true], 200);
        }

        return response()->json(['message' => 'Access is forbidden'], 420);
    }
}
