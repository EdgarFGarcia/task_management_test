<?php

namespace App\Http\Controllers\Task\Service;

/**
 * service layer interface | contract
 */
use App\Http\Controllers\Task\Service\Interface\IServiceTask;

/**
 * repository concrete class
 */
use App\Http\Controllers\Task\Repository\RepositoryTask;

/**
 * laraval facade helper
 */
use Illuminate\Support\Facades\Auth;

class ServiceTask implements IServiceTask
{
    /**
     * class properties
     */
    protected $repo_task;

    /**
     * DIP
     * @App\Http\Controllers\Task\Repository\RepositoryTask
     */
    function __construct(
        RepositoryTask $repo_task
    ){
        $this->repo_task = $repo_task;
    }

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
    ) : object | int | array | string{
        $data['creator_id'] = Auth::user()->id;
        if(isset($data['image'])){
            // image exist, process it
            $filename = time().'.'.$data['image']->getClientOriginalExtension();
            $data['image']->move(public_path(''), $filename);
            $data['image'] = $filename;
        }
        $task_data = $this->repo_task->addATask($data);
        return $task_data;
    }

    /**
     * get tasks
     * @params
     * int $limit,
     * string $title,
     * string $date_sort_by,
     * bool sort_date,
     * bool sort_title,
     *
     * @return
     * object
     */
    public function getTasks(
        int $limit,
        string $title = null,
        int $task_status,
        bool $sort_date,
        bool $sort_title,
        int $is_publish
    ) : object | null | string{
        return $paginate_result = $this->repo_task->getTasks($this->getUser()->id)
            ->where('title', 'like', '%' . $title == null ? '' : $title . '%')
            ->where('task_status_id', $task_status)
            ->where('is_publish', $is_publish)
            ->orderBy('created_at', $sort_date ? 'desc' : 'asc')
            ->orderBy('title', $sort_title ? 'desc' : 'asc')
            ->paginate($limit == 0 ? 10 : $limit);
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
        return $this->repo_task->updateTask($data, $id);
    }

    /**
     | ---------------------------------------------------
     | non interfaced behaviors
     | decorator pattern
     | ---------------------------------------------------
     */
    public function getUser(){
        return Auth::user();
    }
}
