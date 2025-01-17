<?php

namespace App\Modules\Admin\Location\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Location\Http\Requests\CityRequest;
use App\Modules\Admin\Location\Models\City;
use App\Modules\Admin\Location\Models\Country;
use App\Modules\Admin\Location\Services\CityService;
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
        return view('admin.cities.index', compact('cities', 'country'));
    }

    public function show(Country $country, City $city): View
    {
        return view('admin.cities.show', compact('city', 'country'));
    }

    public function create(Country $country): View
    {
        return view('admin.cities.create', compact('country'));
    }

    public function edit(Country $country, City $city): View
    {
        return view('admin.cities.edit', compact('city', 'country'));
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

    public function destroy(Country $country, City $city): RedirectResponse
    {
        $city->delete();
        return back()->with('success', __('success'));
    }
}
