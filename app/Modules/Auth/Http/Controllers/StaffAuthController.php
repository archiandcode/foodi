<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\Staff\LoginRequest;
use App\Modules\Auth\Services\StaffUserAuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StaffAuthController extends Controller
{
    public function __construct(
        protected StaffUserAuthService $service
    ) {}

    public function loginForm(): View {
        return view('panel.auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if (!$this->service->login($request->getData())) {
            return back()->withErrors([
                'email' => 'Неверный логин или пароль.',
            ])->onlyInput('email');
        }

        return redirect()->intended('/admin/dashboard');
    }

    public function logout(): RedirectResponse
    {
        $this->service->logout();
        return redirect()->route('admin.login.form');
    }
}
