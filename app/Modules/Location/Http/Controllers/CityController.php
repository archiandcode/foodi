<?php

namespace App\Modules\Location\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Location\Http\Requests\CityRequest;
use App\Modules\Location\Models\City;
use App\Modules\Location\Models\Country;
use App\Modules\Location\Services\CityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CityController extends Controller
{
    public function __construct(
        protected CityService $service
    ) {}

    public function index(Country $country): View
    {
        $cities = $country->cities()->get();
        return view('admin.cities.index', compact('cities'));
    }

    public function show(City $city): View
    {
        return view('admin.cities.show', compact('city'));
    }

    public function create(Country $country): View
    {
        return view('admin.cities.create', compact('country'));
    }

    public function edit(City $city): View
    {
        return view('admin.cities.edit', compact('city'));
    }

    public function store(CityRequest $request, Country $country): RedirectResponse
    {
        $country->cities()->create($request->validated());
        return redirect()->route('admin.cities.index', $country);
    }

    public function update(City $city, CityRequest $request, Country $country): RedirectResponse
    {
        $city->update($request->validated());
        return redirect()->route('admin.cities.index', $country);
    }
}
