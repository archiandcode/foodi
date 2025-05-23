<?php

namespace App\Modules\Admin\Location\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Location\DTOs\CityData;
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
        $this->authorize('viewAny', City::class);
        $cities = $country->cities()->get();
        return view('panel.admin.cities.index', compact('cities', 'country'));
    }

    public function show(Country $country, City $city): View
    {
        $this->authorize('view', $city);
        return view('panel.admin.cities.show', compact('city', 'country'));
    }

    public function create(Country $country): View
    {
        $this->authorize('create', City::class);
        return view('panel.admin.cities.create', compact('country'));
    }

    public function edit(Country $country, City $city): View
    {
        $this->authorize('update', $city);
        return view('panel.admin.cities.edit', compact('city', 'country'));
    }

    public function store(CityRequest $request, Country $country): RedirectResponse
    {
        $this->authorize('create', City::class);
        $this->service->store($country, CityData::from($request->validated()));
        return redirect()->route('admin.cities.index', $country);
    }

    public function update(CityRequest $request, Country $country, City $city): RedirectResponse
    {
        $this->authorize('update', $city);
        $city->update($request->validated());
        return redirect()->route('admin.cities.index', $country);
    }

    public function destroy(Country $country, City $city): RedirectResponse
    {
        $this->authorize('delete', $city);
        $city->delete();
        return back()->with('success', __('success'));
    }
}
