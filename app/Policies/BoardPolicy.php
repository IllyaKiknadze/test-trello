<?php

namespace App\Policies;

use App\Models\Board;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BoardPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Board $board)
    {

        return $user->id === $board->user_id ? Response::allow()
            : Response::deny('You do not own this board.');
    }

    public function delete(User $user, Board $board)
    {
        return $user->_id === $board->user_id ? Response::allow()
            : Response::deny('You do not own this board.');
    }
}
