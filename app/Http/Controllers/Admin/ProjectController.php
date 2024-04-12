<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('id', 'DESC')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project;
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.form', compact('project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        // valido la richiesta  

        $request->validated();

        //recupero i dati della richiesta
        $data = $request->all();

        //istanzio un nuovo progetto
        $project = new Project;

        //fillo i post con i dati del form
        $project->fill($data);

        $project->slug = Str::slug($project->title);

        $img_path = Storage::put('uploads/projects', $data["image"]);
        $project->image = $img_path;

        $project->save();

        if (Arr::exists('technologies', $data)) {
            $project->technologies()->attach($data["technologies"]);
        }


        return redirect()->route('admin.project.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.form', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $request->validated();

        $data = $request->all();

        $project->fill($data);
        $project->slug = Str::slug($project->title);

        //se è arrivata una nuova img
        if (Arr::exists($data, "image")) {
            //se ce n era una prima
            if (!empty($project->image)) {
                //la elimino
                Storage::delete($project->image);
            }
            //salva l anuova img
            $img_path = Storage::put('uploads/projects', $data["image"]);
            $project->image = $img_path;
        }
        $project->save();


        if (Arr::exists($data, 'technologies')) {
            $project->technologies()->sync($data["technologies"]);
        } else {
            $project->technologies()->detach();
        }


        return redirect()->route('admin.project.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->back();
    }


    public function destroyImg(Project $project)
    {
        Storage::delete($project->image);
        $project->image = null;
        $project->save();
        return redirect()->back();
    }
}
