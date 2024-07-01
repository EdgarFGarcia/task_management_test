<?php

namespace App\Http\Controllers\Task\Service\Interface;

interface IServiceTask
{
    /**
     * add a task
     * @params
     * array $data
     *
     * @return
     * object | int | array | string
     */
    public function addATask(
        array $data
    ) : object | int | array | string;

    /**
     * get tasks
     * @params
     * int $limit,
     * string $title,
     * int $task_status,
     * bool $sort_date,
     * bool $sort_title,
     * int $is_publish
     *
     * @return
     * object | null | string
     */
    public function getTasks(
        int $limit,
        string $title,
        int $task_status,
        bool $sort_date,
        bool $sort_title,
        int $is_publish
    ) : object | null  | string;

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
