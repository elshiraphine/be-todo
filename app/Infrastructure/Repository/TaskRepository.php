<?php

namespace App\Infrastructure\Repository;

use App\Core\Entity\Task;

class TaskRepository
{
    /**
     * @param array $data
     * @return Task
     */
    public function create(array $data)
    {
        return Task::create($data);
    }

    /**
     * @param Task $task
     * @param array $data
     * @return Task|null
     */
    public function update(Task $task, array $data): ?Task
    {
        $task->update($data);
        return $task->fresh();
    }

    /**
     * @param Task $task
     */
    public function delete(Task $task): void
    {
        $task->delete();
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function findByUserId($userId)
    {
        return Task::where('user_id', $userId)->get();
    }
}
