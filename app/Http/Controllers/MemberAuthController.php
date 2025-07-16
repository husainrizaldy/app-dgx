<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberAuthController extends Controller
{
    // Page Login
    public function login()
    {
        return view('pages.login');
    }

    // Login
    public function loginStore(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('member')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/submission')->with('success', 'Berhasil login!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    // Page registrasi
    public function register()
    {
        return view('pages.registration');
    }

    // registrasi
    public function registerStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:members,email',
            'password' => 'required|min:6',
            'agency' => 'nullable|string|max:255',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Member::create($validated);

        return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('member')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout.');
    }
}
