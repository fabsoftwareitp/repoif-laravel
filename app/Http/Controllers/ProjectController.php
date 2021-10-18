<?php

namespace App\Http\Controllers;

class ProjectController extends Controller
{
    /**
     * Display the main view with the projects.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('project.index');
    }

    /**
     * Display the create project view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('project.create');
    }
}
