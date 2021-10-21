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
            'file' => ['required', 'file', 'mimes:png,jpg,jpge', 'max:5120'],
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
            Project::create([
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->type,
                'path' => $filePath,
                'file_name' => $requestFile->getClientOriginalName(),
                'user_id' => $userId,
            ]);
        }

        return redirect(URL::route('project.index'));
    }
}
