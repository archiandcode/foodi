<?php

namespace App\Modules\Admin\Location\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Location\DTOs\CountryData;
use App\Modules\Admin\Location\Http\Requests\CountryRequest;
use App\Modules\Admin\Location\Models\Country;
use App\Modules\Admin\Location\Services\CountryService;
use App\Modules\Api\Location\Resources\CountryResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CountryController extends Controller
{
    public function __construct(
        protected CountryService $service
    ) {}

    public function index(): View
    {
        $this->authorize('viewAny', Country::class);

        $countries = $this->service->getCountriesWithPaginate();
        return view('panel.admin.countries.index', compact('countries'));
    }

    public function json(): JsonResponse
    {
        return response()->json(CountryResource::collection($this->service->getCountries()));
    }

    public function show(Country $country): View
    {
        $this->authorize('view', $country);

        return view('panel.admin.countries.show', compact('country'));
    }

    public function create(): View
    {
        $this->authorize('create', Country::class);

        return view('panel.admin.countries.create');
    }

    public function edit(Country $country): View
    {
        $this->authorize('update', $country);

        return view('panel.admin.countries.edit', compact('country'));
    }

    public function store(CountryRequest $request): RedirectResponse
    {
        $this->authorize('create', Country::class);

        $this->service->store(CountryData::from($request->validated()));
        return redirect()->route('admin.countries.index');
    }

    public function update(Country $country, CountryRequest $request): RedirectResponse
    {
        $this->authorize('update', $country);

        $this->service->update($country, CountryData::from($request->validated()));
        return redirect()->route('admin.countries.index');
    }

    public function destroy(Country $country): RedirectResponse
    {
        $this->authorize('delete', $country);

        if (! $this->service->delete($country)) {
            return redirect()->route('admin.countries.index')
                ->with('error', 'Невозможно удалить страну, так как к ней привязаны города.');
        }

        return redirect()->route('admin.countries.index')
            ->with('success', 'Страна успешно удалена.');
    }
}
