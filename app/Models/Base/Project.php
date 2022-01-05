<?php

/**
 * Generated file
 */

namespace App\Models\Base;



/**
 * Class Project
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models\Base
 */
class Project extends \Illuminate\Database\Eloquent\Model
{
	protected $fillable = [
		'name',
		'description'
	];
}
