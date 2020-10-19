<?php

namespace App\Traits;

use App\Models\Board;
use App\Models\Labels;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait TaskTrait
{
    /**
     * @param string $title
     * @param string $board_id
     * @param string $user_id
     * @param string|null $description
     * @param string $status_id
     * @return mixed
     */
    public function createTask(string $title, string $board_id, string $user_id, ?string $description, string $status_id)
    {
        return Task::create([
            'title'       => $title,
            'board_id'    => $board_id,
            'status_id'   => $status_id,
            'user_id'     => $user_id,
            'description' => $description,
        ]);
    }

    /**
     * @param Task $task
     * @param string $title
     * @param string $board_id
     * @param string $user_id
     * @param string|null $description
     * @param string $statusId
     * @return mixed
     */
    public function editTask(Task $task, string $title, string $board_id, string $user_id, ?string $description, string $statusId)
    {
        $task->update([]);
    }

    public function setTaskLabels(string $id, array $labels)
    {
        $labels = Labels::whereIn('_id', Arr::flatten($labels))->get()->keyBy('id')->toArray();

        return Task::where('id', $id)->update(['labels' => $labels]);
    }
}
