<?php

namespace App\Modules\Public\RestaurantApplication\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Public\RestaurantApplication\Http\Requests\RestaurantApplicationRequest;
use App\Modules\Public\RestaurantApplication\Models\RestaurantApplication;
use Illuminate\View\View;

class RestaurantApplicationController extends Controller
{
    public function create(): View
    {
        return view('public.restaurant_application.create');
    }

    public function store(RestaurantApplicationRequest $request)
    {
        RestaurantApplication::create($request->all());
        notify()->success('Restaurant application created successfully!');
        return redirect()->route('home');
    }
}
