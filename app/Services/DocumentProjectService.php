<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class DocumentProjectService
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        $requestFile = $request->file('file');

        $userId =  Auth::id();

        $filePath = Storage::putFile('usuarios/' . $userId . '/documentos', $requestFile);

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
