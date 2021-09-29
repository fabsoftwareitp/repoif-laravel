<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Display the password change request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.change-password');
    }

    /**
     * Handle an incoming password change request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'min:6', 'current_password'],
            'new_password' => ['required', 'confirmed', 'min:6'],
        ]);

        Auth::user()->forceFill([
            'password' => Hash::make($request->new_password),
        ])->save();

        return back()->with('status', 'Senha alterada com sucesso.');
    }
}
