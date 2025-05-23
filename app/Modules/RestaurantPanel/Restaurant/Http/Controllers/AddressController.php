<?php

namespace App\Modules\RestaurantPanel\Restaurant\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\RestaurantPanel\Restaurant\DTOs\AddressData;
use App\Modules\RestaurantPanel\Restaurant\Models\RestaurantAddress;
use App\Modules\RestaurantPanel\Restaurant\Http\Requests\AddressRequest;
use App\Modules\RestaurantPanel\Restaurant\Services\AddressService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AddressController extends Controller
{
    public function __construct(
        protected AddressService $service
    ) {}

    public function index(): View
    {
        $this->authorize('viewAny', RestaurantAddress::class);
        $restaurant = $this->service->getCurrentRestaurant();
        $addresses = $restaurant->addresses()->get();

        return view('panel.restaurant.addresses.index', compact('addresses'));
    }

    public function create(): View
    {
        $this->authorize('create', RestaurantAddress::class);
        return view('panel.restaurant.addresses.create');
    }

    public function store(AddressRequest $request): RedirectResponse
    {
        $this->authorize('create', RestaurantAddress::class);

        $this->service->store(AddressData::from($request->validated()));

        return redirect()
            ->route('admin.addresses.index')
            ->with('success', 'Адрес успешно добавлен');
    }

    public function show(RestaurantAddress $address): View
    {
        $this->authorize('view', $address);
        return view('panel.restaurant.addresses.show', compact('address'));
    }

    public function edit(RestaurantAddress $address): View
    {
        $this->authorize('update', $address);
        return view('panel.restaurant.addresses.edit', compact('address'));
    }

    public function update(AddressRequest $request, RestaurantAddress $address): RedirectResponse
    {
        $this->authorize('update', $address);

        $this->service->update($address, AddressData::from($request->validated()));

        return redirect()
            ->route('admin.addresses.index')
            ->with('success', 'Адрес успешно обновлён');
    }

    public function destroy(RestaurantAddress $address): RedirectResponse
    {
        $this->authorize('delete', $address);

        $address->delete();

        return back();
    }
}
