<?php

namespace App\Http\Controllers\Task\Repository;

/**
 * repository interface | contract
 */
use App\Http\Controllers\Task\Repository\Interface\IRepositoryTask;

/**
 * model
 */
use App\Models\Task;

class RepositoryTask implements IRepositoryTask
{
    /**
     * add a task
     * @params
     * array $data
     *
     * @return
     * object | int
     */
    public function addATask(
        array $data
    ) : object | int{
        return Task::create($data);
    }

    /**
     * get tasks
     * @params
     * int $user_id,
     *
     * @return
     * object
     */
    public function getTasks(
        int $user_id
    ) : object | null{
        return Task::where('creator_id', $user_id);
    }

    /**
     * update tasks
     * @params
     * array $data
     *
     * @return
     * object
     */
    public function updateTask(
        array $data,
        int $id
    ) : object | int{
        return Task::where('id', $id)
        ->update($data);
    }

    /**
     * soft delete a task
     * @params
     * int $id
     *
     * @return
     * int | bool
     */
    public function deleteTask(
        int $id
    ) : int | bool{
        return Task::where('id', $id)->delete();
    }
}
