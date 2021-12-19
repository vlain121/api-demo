<?php

/**
 * Generated file
 */

namespace App\Models\Base;



/**
 * Class TaskCategory
 * 
 * @property int $task_id
 * @property int $category_id
 * 
 * @property \App\Models\Base\Category $category
 * @property \App\Models\Base\Task $task
 *
 * @package App\Models\Base
 */
class TaskCategory extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'task_category';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'task_id' => 'int',
		'category_id' => 'int'
	];

	protected $fillable = [
		'task_id',
		'category_id'
	];

	public function category()
	{
		return $this->belongsTo(\App\Models\Base\Category::class);
	}

	public function task()
	{
		return $this->belongsTo(\App\Models\Base\Task::class);
	}
}
