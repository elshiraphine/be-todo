<?php

namespace App\Application\Services\TaskServices;

use App\Infrastructure\Repository\TaskRepository;

class CreateTaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param array $data
     * @param int $userId
     * @return \App\Core\Entity\Task
     */
    public function create(array $data, int $userId): \App\Core\Entity\Task
    {
        $data['user_id'] = $userId;
        return $this->taskRepository->create($data);
    }
}
