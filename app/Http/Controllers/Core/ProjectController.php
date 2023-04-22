<?php

namespace App\Http\Controllers\Core;

use App\Actions\GenerateKeysAction;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Core\Client;
use App\Models\Core\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return ProjectResource::collection(Project::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request, Client $client) {
        $project = $client->projects->create($request->only(['name']));

        return new ProjectResource($project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project) {
        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project) {
        $project->update($request->only(['name']));

        return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project) {
        $project->delete();

        return response()->json(['message' => 'Project deleted!']);
    }

    public function generateKeys (Project $project, GenerateKeysAction $generateKeys) {
        return new ProjectResource($generateKeys->handle($project));
    }
}
