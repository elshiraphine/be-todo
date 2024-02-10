<?php

namespace App\Application\Services\TaskServices;

use App\Infrastructure\Repository\TaskRepository;

class ShowTaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function show($userId)
    {
        return $this->taskRepository->findByUserId($userId);
    }
}
