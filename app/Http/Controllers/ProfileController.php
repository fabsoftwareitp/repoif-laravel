<?php

namespace App\Http\Controllers;

use Crawler;
use App\Services\ProjectListService;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user profile view.
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request, User $user)
    {
        if (! Crawler::isCrawler()) {
            $viewedProfiles = $request->session()->get('viewed_profiles', []);

            if (! in_array($user->id, $viewedProfiles)) {
                $user->profile_views += 1;
                $user->save();
                $request->session()->push('viewed_profiles', $user->id);
            }
        }

        $projects = ProjectListService::getProjects($request, $user->id);

        return view('profile.show', ['user' => $user, 'projects' => $projects]);
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
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'ends_with:@aluno.ifsp.edu.br', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'file', 'mimes:png,jpg,jpeg', 'max:5120'],
            'description' => ['nullable', 'string', 'max:200'],
            'deleted_image' => ['required', 'in:true,false'],
        ]);

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

        if ($user->email !== $request->email) {
            $user->email_verified_at = null;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->description = $request->description;
        $user->completed_profile = true;
        $user->save();

        if (! $user->email_verified_at) {
            $user->sendEmailVerificationNotification();
            return redirect(URL::route('verification.notice'));
        }

        return redirect(URL::route('profile.show', ['user' => $user->id]))
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
