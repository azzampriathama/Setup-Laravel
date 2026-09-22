<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], attributes: [
            'login' => 'nama pengguna/email',
            'password' => 'kata sandi',
        ]);

        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (! Auth::attempt([$field => $credentials['login'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'login' => 'Nama pengguna/email atau kata sandi tidak sesuai.',
            ]);
        }

        $request->session()->regenerate();

        if (Auth::user()->isAdmin()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'login' => 'Akun ini adalah akun admin. Silakan masuk lewat halaman Masuk Sebagai Admin.',
            ]);
        }

        return redirect()->intended(route('home'))
            ->with('success', 'Selamat datang kembali, '.Auth::user()->name.'!');
    }

    public function showAdminLogin(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.admin-login');
    }

    public function adminLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], attributes: [
            'login' => 'ID admin/email',
            'password' => 'kata sandi',
        ]);

        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (! Auth::attempt([$field => $credentials['login'], 'password' => $credentials['password']])) {
            throw ValidationException::withMessages([
                'login' => 'ID admin/email atau kata sandi tidak sesuai.',
            ]);
        }

        $request->session()->regenerate();

        if (! Auth::user()->isAdmin()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'login' => 'Akun ini bukan akun admin.',
            ]);
        }

        return redirect()->route('admin.dashboard')
            ->with('success', 'Selamat datang, '.Auth::user()->name.'!');
    }

    public function logout(Request $request): RedirectResponse
    {
        $wasAdmin = Auth::user()?->isAdmin() ?? false;

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route($wasAdmin ? 'admin.login' : 'home')
            ->with('success', 'Kamu berhasil keluar.');
    }
}
