<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProjectApiResource;
use App\Services\Api\ProjectApiService;
use Exception;
use Illuminate\Http\Request;

class ProjectApiController extends Controller
{
    private $project_api_service;
    public function __construct(ProjectApiService $project_api_service)
    {
        $this->project_api_service = $project_api_service;
    }

    public function index(Request $request)
    {
        try {
            $projects = $this->project_api_service->getList($request);
            return ProjectApiResource::collection($projects);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 400);
        }
    }

    /**
     *
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        try {
            $project = $this->project_api_service->create($request);
            return new ProjectApiResource($project);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 400);
        }
    }
}
