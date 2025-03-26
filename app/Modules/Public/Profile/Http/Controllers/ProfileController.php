<?php

namespace App\Modules\Public\Profile\Http\Controllers;

use App\Modules\Shared\Traits\InteractsWithAuthUse;
use App\Modules\StaffUser\Http\Requests\ProfileRequest;

class ProfileController
{
    use InteractsWithAuthUse;

    public function index()
    {
        $user = $this->user();
        return view('public.profile.index', compact('user'));
    }

    public function edit()
    {
        $user = $this->user();
        return view('public.profile.edit', compact('user'));
    }

    public function update(ProfileRequest $request)
    {
        $user = $this->user();
        $user->update($request->validated());
        return redirect()->route('profile.index');
    }
}
