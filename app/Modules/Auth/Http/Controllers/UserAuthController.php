<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\User\LoginRequest;
use App\Modules\Auth\Http\Requests\User\RegisterRequest;
use App\Modules\Auth\Services\UserAuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserAuthController extends Controller
{
    public function __construct(
        protected UserAuthService $service,
    ) {}

    public function loginForm(): View
    {
        return view('public.auth.login');
    }

    public function registerForm(): View
    {
        return view('public.auth.register');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if (!$this->service->login($request->getData())) {
            return back()->withErrors([
                'email' => 'Неверный email или пароль.',
            ])->onlyInput('email');
        }

        return redirect('/');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $this->service->register($request->getData());
        return redirect('/');
    }

    public function logout(): RedirectResponse
    {
        $this->service->logout();
        return redirect()->route('login');
    }
}
