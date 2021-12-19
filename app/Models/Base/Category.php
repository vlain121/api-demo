<?php

/**
 * Generated file
 */

namespace App\Models\Base;



/**
 * Class Category
 * 
 * @property int $id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Base\Task[] $tasks
 * @property \App\Models\Base\TaskCategory $task_category
 *
 * @package App\Models\Base
 */
class Category extends \Illuminate\Database\Eloquent\Model
{
	protected $fillable = [
		'title'
	];

	public function tasks()
	{
		return $this->belongsToMany(\App\Models\Base\Task::class, 'task_category', 'category_id');
	}

	public function task_category()
	{
		return $this->hasOne(\App\Models\Base\TaskCategory::class);
	}
}
