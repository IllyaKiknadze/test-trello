<?php

namespace App\Traits;

use App\Models\Board;
use Illuminate\Support\Collection;

trait BoardTrait
{
    public function getUserBoards(string $uId): Collection
    {
        return Board::where('user_id', $uId)->with('owner')->get();
    }

    public function createBoard(string $title, string $uId)
    {
        return Board::create([
            'title'   => $title,
            'user_id' => $uId
        ]);
    }
}
