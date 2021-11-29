<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\URL;

class ImageProjectService
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:png,jpg,jpeg', 'max:5120'],
        ]);

        $requestFile = $request->file('file');
        $pathToSaveFile = $requestFile->getRealPath() . '.jpg';

        Image::make($requestFile)
            ->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($pathToSaveFile, 60);

        $userId =  Auth::id();

        $filePath = Storage::putFile('usuarios/' . $userId . '/imagens', new File($pathToSaveFile));

        if ($filePath) {
            $project = Project::create([
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->type,
                'path' => $filePath,
                'file_name' => substr($requestFile->getClientOriginalName(), 0, 255),
                'user_id' => $userId,
            ]);
        }

        return redirect(URL::route('project.show', ['project' => $project->id]));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'file' => ['nullable', 'file', 'mimes:png,jpg,jpeg', 'max:5120'],
        ]);

        $requestFile = $request->file('file');

        if ($requestFile) {
            $deleted = Storage::delete($project->path);

            if ($deleted) {
                $pathToSaveFile = $requestFile->getRealPath() . '.jpg';

                Image::make($requestFile)
                    ->resize(1200, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($pathToSaveFile, 60);

                $filePath = Storage::putFile('usuarios/' . $project->user_id . '/imagens', new File($pathToSaveFile));

                if ($filePath) {
                    $project->path = $filePath;
                    $project->file_name = substr($requestFile->getClientOriginalName(), 0, 255);
                }
            }
        }

        $project->title = $request->title;
        $project->description = $request->description;
        $project->save();

        return redirect(URL::route('project.show', ['project' => $project->id]));
    }
}
