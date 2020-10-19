<?php

namespace App\Observers;

use App\Models\Task;
use App\Services\LogService;
use Illuminate\Http\Request;

class TaskObserver
{
    /**
     * @var LogService
     */
    private LogService $logService;
    /**
     * @var Request
     */
    private Request $request;

    /**
     * TaskObserver constructor.
     * @param LogService $logService
     * @param Request $request
     */
    public function __construct(LogService $logService, Request $request)
    {
        $this->logService = $logService;
        $this->request = $request;
    }

    /**
     * Handle the task "created" event.
     *
     * @param Task $task
     * @return void
     */
    public function creating(Task $task)
    {
        $this->logService->logTaskChanged($this->request->user()->_id, 'creating', $task);
    }

    /**
     * Handle the task "updated" event.
     *
     * @param Task $task
     * @return void
     */
    public function updating(Task $task)
    {
        $this->logService->logTaskChanged($this->request->user()->_id, 'updating', $task);
    }

    /**
     * Handle the task "deleted" event.
     *
     * @param Task $task
     * @return void
     */
    public function deleting(Task $task)
    {
        $this->logService->logTaskChanged($this->request->user()->_id, 'deleting', $task);
    }
}
