<?php

namespace App\Http\Requests\Api;

use App\Enums\SubTaskStatusType;
use App\Enums\TaskPrioType;
use App\Enums\TaskStatusType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApiCreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'desc' => 'nullable',
            'due_date' => 'nullable|date',
            'spent_time' => 'nullable|date_format:H:i:s',
            'status' => Rule::in(TaskStatusType::getValues()),
            'priority' => Rule::in(TaskPrioType::getValues()),
            'sub_tasks' => 'nullable|array',
            'sub_tasks.*' => 'array',
            'sub_tasks.*.title' => 'string',
            'sub_tasks.*.status' => Rule::in(SubTaskStatusType::getValues()),
        ];
    }
}
