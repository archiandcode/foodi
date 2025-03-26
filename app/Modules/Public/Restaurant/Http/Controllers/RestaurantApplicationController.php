<?php

namespace App\Modules\Public\Restaurant\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Public\Restaurant\Http\Requests\RestaurantApplicationRequest;
use App\Modules\Public\Restaurant\Models\RestaurantApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RestaurantApplicationController extends Controller
{
    public function create(): View
    {
        return view('public.restaurant_application.create');
    }

    public function store(RestaurantApplicationRequest $request): RedirectResponse
    {
        RestaurantApplication::query()->create($request->validated());
        notify()->success('','Заявка успешно отправлено!');
        return redirect()->route('home');
    }
}
