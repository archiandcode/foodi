<?php

namespace App\Modules\Admin\Location\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Location\Http\Requests\CountryRequest;
use App\Modules\Admin\Location\Models\Country;
use App\Modules\Admin\Location\Services\CountryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CountryController extends Controller
{
    public function __construct(
        protected CountryService $service
    ) {}

    public function index(): View
    {
        $countries = Country::all();
        return view('admin.countries.index', compact('countries'));
    }

    public function show(Country $country): View
    {
        return view('admin.countries.show', compact('country'));
    }

    public function create(): View
    {
        return view('admin.countries.create');
    }

    public function edit(Country $country): View
    {
        return view('admin.countries.edit', compact('country'));
    }

    public function store(CountryRequest $request): RedirectResponse
    {
        Country::query()->create($request->validated());
        return redirect()->route('admin.countries.index');
    }

    public function update(Country $country, CountryRequest $request): RedirectResponse
    {
        $country->update($request->validated());
        return redirect()->route('admin.countries.index');
    }

    public function destroy(Country $country): RedirectResponse
    {
        $country->delete();
        return redirect()->route('admin.countries.index');
    }
}
