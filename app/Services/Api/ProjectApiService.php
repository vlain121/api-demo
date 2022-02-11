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

    /**
     *
     *
     * @param Request $request
     * @return App\Model\Projec|null
     */
    public function create(Request $request)
    {
        try {
            $project = Project::insert($request->all());
            return $project;
        } catch (Exception $e) {
            return null;
        }
    }

    public function update($id, Request $request)
    {
        try {
            $project = Project::find($id);
            $project->update($request->all());
            return $project;
        } catch (Exception $e) {
            return null;
        }
    }

    public function detail($slug)
    {
        try {
            $project = Project::where('slug', $slug)->first();
            return $project;
        } catch (Exception $e) {
            return null;
        }
    }
}
