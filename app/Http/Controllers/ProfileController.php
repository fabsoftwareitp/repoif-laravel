<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\URL;

class ProfileController extends Controller
{
    /**
     * Display the user profile view.
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request, User $user)
    {
        $viewedProfiles = $request->session()->get('viewed_profiles', []);

        if (! in_array($user->id, $viewedProfiles)) {
            $user->profile_views += 1;
            $user->save();
            $request->session()->push('viewed_profiles', $user->id);
        }

        return view('profile.show', ['user' => $user]);
    }

    /**
     * Display the edit user profile view.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    /**
     * Handle an incoming update profile request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'file', 'mimes:png,jpg,jpeg', 'max:5120'],
            'description' => ['nullable', 'string', 'max:200'],
            'deleted_image' => ['required', 'in:true,false'],
        ]);

        $user = Auth::user();

        if ($request->deleted_image === 'true' && $user->photo_path) {
            $deleted = Storage::delete($user->photo_path);

            if ($deleted) {
                $user->photo_path = null;
            }
        }

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

        $user->name = $request->name;
        $user->description = $request->description;
        $user->save();

        return redirect(URL::route('profile.show', ['user' => Auth::user()]))
            ->with('status', 'Perfil editado com sucesso.');
    }

    /**
     * Destroy the user account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $user->delete();

        Storage::deleteDirectory('usuarios/' . $user->id);

        return redirect('/');
    }
}
