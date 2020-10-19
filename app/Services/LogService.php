<?php


namespace App\Services;


use App\Models\LogModel;
use App\Models\Task;

class LogService
{
    /**
     * @param string $changedBy
     * @param string $action
     * @param Task $task
     */
    public function logTaskChanged(string $changedBy, string $action, Task $task)
    {
        LogModel::insert([
            'changed_by'   => $changedBy,
            'action'       => $action,
            'task_id'      => $task->_id,
            'dirty_fields' => $task->getDirty()
        ]);
    }
}
