<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Http\Request;

class WebProjectService
{
    private $servicesByWebProjectSource;

    public function __construct()
    {
        $this->servicesByWebProjectSource = [
            '1' => new CompressedWebProjectService(),
            '2' => new GitHubWebProjectService(),
        ];
    }

    public function store(Request $request)
    {
        $request->validate([
            'source' => ['required', 'in:1,2'],
        ]);

        $webProjectService = $this->servicesByWebProjectSource[$request->source];

        return $webProjectService->store($request);
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'source' => ['required', 'in:1,2'],
        ]);

        $webProjectService = $this->servicesByWebProjectSource[$request->source];

        return $webProjectService->update($request, $project);
    }
}
