<?php

namespace App\Services;

use ZipArchive;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class CompressedWebProjectService
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:zip', 'max:5120'],
        ]);

        $requestFile = $request->file('file');

        $userId =  Auth::id();

        $baseWebProjectsPath = 'usuarios/' . $userId . '/projetos-web';

        $zipFilePath = Storage::putFile($baseWebProjectsPath . '/compactados', $requestFile);

        if ($zipFilePath) {
            $zipHandler = new ZipArchive();
            $zipHandler->open(public_path('storage/' . $zipFilePath));

            $extractedZipFilePath = str_replace(['compactados', '.zip'], ['extraidos', ''], $zipFilePath);

            $hasExtracted = $zipHandler->extractTo(public_path('storage/' . $extractedZipFilePath));
            $zipHandler->close();

            if ($hasExtracted) {
                Project::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'type' => $request->type,
                    'path' => $zipFilePath,
                    'path_web' => $extractedZipFilePath,
                    'file_name' => $requestFile->getClientOriginalName(),
                    'user_id' => $userId,
                ]);
            }
        }

        return redirect(URL::route('project.index'));
    }

    public function update(Request $request, Project $project)
    {
        $obligatoriness = $project->path_web ? 'nullable' : 'required';

        $request->validate([
            'file' => [$obligatoriness, 'file', 'mimes:zip', 'max:5120'],
        ]);

        $requestFile = $request->file('file');

        if ($requestFile) {
            if ($project->path_web) {
                Storage::delete($project->path);
                Storage::deleteDirectory($project->path_web);
            }

            $baseWebProjectsPath = 'usuarios/' . $project->user_id . '/projetos-web';

            $zipFilePath = Storage::putFile($baseWebProjectsPath . '/compactados', $requestFile);

            if ($zipFilePath) {
                $zipHandler = new ZipArchive();
                $zipHandler->open(public_path('storage/' . $zipFilePath));

                $extractedZipFilePath = str_replace(['compactados', '.zip'], ['extraidos', ''], $zipFilePath);

                $hasExtracted = $zipHandler->extractTo(public_path('storage/' . $extractedZipFilePath));
                $zipHandler->close();

                if ($hasExtracted) {
                    $project->path = $zipFilePath;
                    $project->path_web = $extractedZipFilePath;
                    $project->file_name = $requestFile->getClientOriginalName();
                }
            }
        }

        $project->title = $request->title;
        $project->description = $request->description;
        $project->url = null;
        $project->save();

        return redirect(URL::route('project.index'));
    }
}
