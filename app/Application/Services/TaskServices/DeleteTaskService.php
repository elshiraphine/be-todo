<?php

namespace App\Application\Services\TaskServices;

use App\Core\Entity\Task;
use App\Infrastructure\Repository\TaskRepository;
class DeleteTaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function delete(Task $task): void
    {
        $this->taskRepository->delete($task);
    }
}
