<?php

namespace App\Models;

use App\Models\Base\Project as BaseProject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Project extends BaseProject
{
    use HasFactory;

    public function setSlugAttribute($value)
    {
        return Str::slug($value);
    }
}
