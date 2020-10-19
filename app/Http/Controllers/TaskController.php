<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\EditTaskRequest;
use App\Http\Requests\SetLabelsRequest;
use App\Http\Resources\TaskResource;
use App\Jobs\CropImages;
use App\Models\Task;
use App\Traits\TaskTrait;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    use TaskTrait;

    public function setLabels(SetLabelsRequest $request)
    {
        if ($task = $this->setTaskLabels($request->_id, $request->labels)) {
            return response()->json(['task' => TaskResource::make($task)], 200);
        }

        return response()->json(['success' => false, 'message' => 'Can set labels. Server error!'], 400);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateTaskRequest $request
     * @return JsonResponse
     */
    public function create(CreateTaskRequest $request)
    {
        if ($task = $this->createTask($request->title, $request->board_id, $request->user_id,
            $request->description, $request->status_id)) {

            if ($request->has('images')) {
                CropImages::dispatch($request->images, $task->id);
            }

            return response()->json(['task' => TaskResource::make(Task::find($task->id))], 200);
        }

        return response()->json(['success' => false, 'message' => 'Can not create task. Server error!'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return JsonResponse
     */
    public function getSingleTask(Task $task)
    {
        return response()->json(['task' => TaskResource::make($task)], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditTaskRequest $request
     * @param Task $task
     * @return JsonResponse
     */
    public function update(EditTaskRequest $request, Task $task)
    {
        if ($task->update($request->only(['title', 'board_id', 'user_id', 'status_id', 'description']))) {
            if ($request->has('images')) {
                CropImages::dispatch($request->images, $task->id);
            }
            return response()->json(['task' => TaskResource::make($task)], 200);
        }

        return response()->json(['success' => false, 'message' => 'Can not create task. Server error!'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(Task $task)
    {
        if ($task->delete()) {
            return response()->json(['success' => true, 'message' => 'task was deleted successfully'], 200);
        }

        return response()->json(['success' => false, 'message' => 'Can not delete task. Server error!'], 400);
    }
}
