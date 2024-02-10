<?php

namespace App\Http\Controllers;

use App\Application\Services\TaskServices\CreateTaskService;
use App\Application\Services\TaskServices\DeleteTaskService;
use App\Application\Services\TaskServices\ShowTaskService;
use App\Application\Services\TaskServices\TaskRequest;
use App\Application\Services\TaskServices\UpdateTaskService;
use App\Core\Entity\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TaskController
{
    protected $createTaskService;
    protected $updateTaskService;
    protected $deleteTaskService;
    protected $showTaskService;

    public function __construct(
        CreateTaskService $createTaskService,
        UpdateTaskService $updateTaskService,
        DeleteTaskService $deleteTaskService,
        ShowTaskService $showTaskService
    ) {
        $this->createTaskService = $createTaskService;
        $this->updateTaskService = $updateTaskService;
        $this->deleteTaskService = $deleteTaskService;
        $this->showTaskService = $showTaskService;
    }

    public function index(): JsonResponse
    {
        $userId = Auth::id();
        $tasks = $this->showTaskService->show($userId);
        return apiResponse(200, 'success', ['tasks' => $tasks]);
    }

    public function store(TaskRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $task = $this->createTaskService->create($data, $data['user_id']);
        return apiResponse(201, 'success', ['task' => $task]);
    }

    public function update(TaskRequest $request, Task $task): JsonResponse
    {
        $data = $request->validated();
        $task = $this->updateTaskService->update($task, $data);
        return apiResponse(200, 'success', ['task' => $task]);
    }

    public function destroy(Task $task): JsonResponse
    {
        $this->deleteTaskService->delete($task);
        return apiResponse(200, 'success', ['message' => 'Task deleted successfully']);
    }
}
