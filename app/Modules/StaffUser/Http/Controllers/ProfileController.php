<?php

namespace App\Modules\StaffUser\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\StaffUser\Http\Requests\ProfileRequest;
use App\Modules\StaffUser\Models\StaffUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        /** @var StaffUser $user */
        $user = auth()->guard('staff')->user();
        return view('panel.profile.index', compact('user'));
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        /** @var StaffUser $user */
        $user = auth()->user();

        $user->email = $request->input('email');
        $user->name = $request->input('name');

        if ($request->filled('password')) {
            $user->password = $request->input('password');
        }

        $user->save();

        return redirect()->route('admin.profile')
            ->with('success', __('Профиль успешно обновлён!'));
    }
}
