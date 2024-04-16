<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::select(['id', 'type_id', 'title', 'content', 'image', 'slug'])
            ->with(['type:id,label,color', 'technologies:id,label,color'])
            ->orderBy('created_at', 'DESC')
            ->paginate();


        foreach ($projects as $project) {
            $project->image = !empty($project->image) ? asset('/storage/' . $project->image) : 'https://placehold.co/600x400';
        }



        return response()->json($projects);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project = Project::select(['id', 'type_id', 'title', 'content', 'image', 'slug'])
            ->where('slug', $slug)
            ->with(['type:id,label,color', 'technologies:id,label,color'])
            ->first()
            ->paginate();

        $project->image = !empty($project->image) ? asset('/storage/' . $project->image) : 'https://placehold.co/600x400';
        return response()->json($project);
    }
}
