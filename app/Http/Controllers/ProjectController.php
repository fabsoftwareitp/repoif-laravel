<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\DocumentProjectService;
use App\Services\ImageProjectService;
use App\Services\VideoProjectService;
use App\Services\WebProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ProjectController extends Controller
{
    private $servicesByProjectType;

    public function __construct()
    {
        $this->servicesByProjectType = [
            '1' => new DocumentProjectService(),
            '2' => new ImageProjectService(),
            '3' => new VideoProjectService(),
            '4' => new WebProjectService(),
        ];
    }

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

    /**
     * Handle an incoming store project request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
            'type' => ['required', 'in:1,2,3,4'],
        ]);

        $projectService = $this->servicesByProjectType[$request->type];

        return $projectService->store($request);
    }

    /**
     * Destroy the project.
     *
     * @param  App\Models\Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Project $project)
    {
        abort_if($project->user_id !== Auth::id(), 403);

        if ($project->path) {
            Storage::delete($project->path);
        }

        if ($project->path_web) {
            Storage::deleteDirectory($project->path_web);
        }

        $project->delete();

        return redirect(URL::route('project.index'));
    }
}
