<?php

namespace App\Application\Services\TaskServices;

use App\Core\Entity\Task;
use App\Infrastructure\Repository\TaskRepository;

class UpdateTaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function update(Task $task, array $data)
    {
        return $this->taskRepository->update($task, $data);
    }
}
