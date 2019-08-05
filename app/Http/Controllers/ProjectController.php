<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('project.index', [
            'projects' => Project::all()
        ]);
    }

    public function save()
    {
        $this->validate(request(), [
            'name' => 'required',
            'description' => 'required'
        ]);

        $project = new Project();
        $project->name = request('name');
        $project->description = request('description');
        $project->save();

        return ['message' => 'Project created'];
    }
}
