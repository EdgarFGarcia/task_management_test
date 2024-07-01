<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * service concrete class
 */
use App\Http\Controllers\Task\Service\ServiceTask;

/**
 * validation
 */
use App\Http\Controllers\Task\Validation\ValidateAddTask;
use App\Http\Controllers\Task\Validation\ValidateUpdateTask;

class CTasks extends Controller
{
    /**
     * class properties
     */
    protected $service_task;

    /**
     * DIP
     * @App\Http\Controllers\Task\Service\ServiceTask
     */
    function __construct(
        ServiceTask $service_task
    ){
        $this->service_task = $service_task;
    }

    /**
     * add a task
     * @params
     * Request $request
     *
     * validation inject
     * @App\Http\Controllers\Task\Validation\ValidateAddTask
     *
     * @return
     * object | array
     */
    public function addATask(
        ValidateAddTask $request
    ) : object | array | string{
        try{
            return $add_task = $this->service_task->addATask($request->all());
            return response()->json([
                'response'  => true
            ], 200);
        }catch(\Exception $e){
            return $this->error($e, 500);
        }
    }

    /**
     * get tasks
     * @urlparams
     * option to dynamically
     * define the limit per page (e.g., 10 per page, 20 per page, etc.)
     * int $limit (default is 10)
     *
     * Request $request
     * - string $title = null
     * - int $task_status
     * - bool $sort_date
     * - bool $sort_title
     * - int $is_publish
     *
     * @return
     * object
     */
    public function getTasks(
        Request $request,
        int $limit = 0
    )  {
        try{
            return $task_data = $this->service_task->getTasks(
                $limit,
                $request->title,
                $request->task_status,
                $request->sort_date,
                $request->sort_title,
                $request->is_publish
            );
            return response()->json([
                'response'  => true,
                'data'      => $task_data
            ], 200);
        }catch(\Exception $e){
            return $this->error($e, 500);
        }
    }

    /**
     * update a task
     * Request $request
     *
     * @Validation inject
     * ValidateUpdateTask
     * @return
     * object
     */
    public function updateATask(
        int $id = null,
        ValidateUpdateTask $request
    ){
        try{
            $update_data = $this->service_task->updateTask($request->validated(), $id);
            if($update_data){
                return response()->json([
                    'response'  => true,
                ], 200);
            }
            return response()->json([
                'response'  => false
            ], 500);
        }catch(\Exception $e){
            return $this->error($e, 500);
        }
    }

    /**
     * soft delete a task
     * @params
     * int $id
     *
     * @return
     * object
     */
    public function deleteTask(
        int $id
    ){
        try{
            $delete_item = $this->service_task->deleteTask($id);
            if($delete_item){
                return response()->json([
                    'response'  => true
                ], 200);
            }
            return response()->json([
                'response'  => false
            ], 500);
        }catch(\Exception $e){
            return $this->error($e, 500);
        }
    }
}
