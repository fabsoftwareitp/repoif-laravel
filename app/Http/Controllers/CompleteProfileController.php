<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\URL;

class CompleteProfileController extends Controller
{
    /**
     * Display the complete profile request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('profile.complete');
    }

    /**
     * Handle an incoming complete profile request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo' => ['nullable', 'file', 'mimes:png,jpg,jpeg', 'max:5120'],
            'description' => ['nullable', 'string', 'max:200'],
        ]);

        $user = Auth::user();

        if ($request->photo) {
            $requestFile = $request->file('photo');
            $filePath = $requestFile->getRealPath() . '.jpg';

            Image::make($requestFile)
                ->fit(1200)
                ->save($filePath, 60);

            $imagePath = Storage::putFile('usuarios/' . $user->id . '/foto', new File($filePath));

            if ($imagePath) {
                $user->photo_path = $imagePath;
            }
        }

        $user->description = $request->description;
        $user->completed_profile = true;
        $user->save();

        return redirect()->intended(URL::route('profile.show', ['user' => $user->id]));
    }
}
