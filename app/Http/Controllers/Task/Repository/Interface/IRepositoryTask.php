<?php

namespace App\Http\Controllers\Task\Repository\Interface;

interface IRepositoryTask
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
    ) : object | int;

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
    ) : object | null;

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
    ) : object | int;

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
    ) : int | bool;
}
