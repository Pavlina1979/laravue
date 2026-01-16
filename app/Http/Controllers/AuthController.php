<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Registrace');
    }

    public function loginForm()
    {
        return Inertia::render('Auth/Prihlaseni');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('tasks.index')->with('success', 'Uživatel ' . Auth::user()->name . ' byl úspěšně přihlášen');

        }
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        User::create($credentials);

        return redirect('/')->with('success', "Uživatel byl úspěšně vytvořen");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


}
