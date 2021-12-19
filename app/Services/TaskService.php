<?php
namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskService
{
    private $model;

    public function __construct(Task $task)
    {
        $this->model = $task;
    }

    /**
     * Get a list of tasks
     *
     * @param Request $request
     * @return void
     */
    public function getList(Request $request)
    {
        try {
            $result = $this->model->with(['categories', 'sub_tasks'])->paginate(5);
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
}
