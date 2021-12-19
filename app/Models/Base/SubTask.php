<?php

/**
 * Generated file
 */

namespace App\Models\Base;



/**
 * Class SubTask
 * 
 * @property int $id
 * @property int $task_id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Base\Task $task
 *
 * @package App\Models\Base
 */
class SubTask extends \Illuminate\Database\Eloquent\Model
{
	protected $casts = [
		'task_id' => 'int'
	];

	protected $fillable = [
		'task_id',
		'title'
	];

	public function task()
	{
		return $this->belongsTo(\App\Models\Base\Task::class);
	}
}
