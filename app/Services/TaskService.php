<?php
namespace App\Services;

use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function create(Request $request)
    {
        DB::beginTransaction();
        try {
            $task = new Task();
            $task->fill($request->all())->save();
            if ($request->has('sub_tasks')) {
                $sub_tasks = $request->get('sub_tasks');
                Log::info($sub_tasks);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return null;
        }
    }
}
