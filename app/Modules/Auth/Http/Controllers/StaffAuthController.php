<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\Staff\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StaffAuthController extends Controller
{
    public function loginForm(): View {
        return view('panel.auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        if (auth()->guard('staff')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }
        return back()->withErrors([
            'email' => 'Неверный логин или пароль.',
        ])->onlyInput('email');
    }

    public function logout(): RedirectResponse
    {
        auth()->guard('staff')->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('admin.login.form');
    }
}
