<?php

/**
 * Generated file
 */

namespace App\Models\Base;



/**
 * Class Task
 * 
 * @property int $id
 * @property string $title
 * @property string $desc
 * @property \Carbon\Carbon $due_date
 * @property \Carbon\Carbon $spent_time
 * @property int $status
 * @property int $priority
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Base\SubTask[] $sub_tasks
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Base\Category[] $categories
 * @property \App\Models\Base\TaskCategory $task_category
 *
 * @package App\Models\Base
 */
class Task extends \Illuminate\Database\Eloquent\Model
{
	protected $casts = [
		'status' => 'int',
		'priority' => 'int'
	];

	protected $dates = [
		'due_date',
		'spent_time'
	];

	protected $fillable = [
		'title',
		'desc',
		'due_date',
		'spent_time',
		'status',
		'priority'
	];

	public function sub_tasks()
	{
		return $this->hasMany(\App\Models\Base\SubTask::class);
	}

	public function categories()
	{
		return $this->belongsToMany(\App\Models\Base\Category::class, 'task_category', 'task_id');
	}

	public function task_category()
	{
		return $this->hasOne(\App\Models\Base\TaskCategory::class);
	}
}
