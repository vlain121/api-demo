<?php
namespace App\Services\Api;

use App\Models\Project;
use Exception;
use Illuminate\Http\Request;

class ProjectApiService
{

    private $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function getList(Request $request)
    {
        try {
            $result = $this->project->get();
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
}
