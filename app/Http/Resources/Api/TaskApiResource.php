<?php

namespace App\Http\Resources\Api;

use App\Enums\TaskPrioType;
use App\Enums\TaskStatusType;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class TaskApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return Arr::except(array_merge(parent::toArray($request), [
            'status_label' => TaskStatusType::getLabel($this->status),
            'priority_label' => TaskPrioType::getLabel($this->priority),
            'sub_tasks' => SubTaskApiResource::collection($this->whenLoaded('sub_tasks')),
            'spent_time' => Carbon::parse($this->spent_time)->format('H:i:s'),
        ]), ['created_at', 'updated_at']);
    }
}
