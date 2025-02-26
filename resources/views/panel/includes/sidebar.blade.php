<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('logo.png') }}" alt="logo" class="brand-image">
        <span class="brand-text font-weight-light text-uppercase font-weight-bold">FOOD PARK</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @can('viewAny', \App\Modules\Public\Restaurant\Models\RestaurantApplication::class)
                    <li class="nav-item">
                        <a href="{{ route('admin.applications.index') }}" class="nav-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>{{ __('Заявки') }}</p>
                        </a>
                    </li>
                @endcan
                @can('viewAny', \App\Modules\Admin\Restaurants\Models\Restaurant::class)
                    <li class="nav-item">
                        <a href="{{ route('admin.restaurants.index') }}" class="nav-link {{ request()->routeIs('admin.restaurants.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cubes"></i>
                            <p>{{ __('Рестораны') }}</p>
                        </a>
                    </li>
                @endcan
                @can('viewAny', \App\Modules\Admin\Location\Models\Country::class)
                    <li class="nav-item">
                        <a href="{{ route('admin.countries.index') }}" class="nav-link {{ request()->routeIs('admin.countries.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>{{ __('Страны') }}</p>
                        </a>
                    </li>
                @endcan
                @can('own', \App\Modules\Admin\Restaurants\Models\Restaurant::class)
                    <li class="nav-item">
                        <a href="{{ route('admin.restaurant.index') }}" class="nav-link {{ request()->routeIs('admin.restaurant.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-store"></i>
                            <p>{{ __('Ресторан') }}</p>
                        </a>
                    </li>
                @endcan
                @can('viewAny', \App\Modules\RestaurantPanel\Restaurant\Models\RestaurantAddress::class)
                    <li class="nav-item">
                        <a href="{{ route('admin.addresses.index') }}" class="nav-link {{ request()->routeIs('admin.addresses.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-map-marker-alt"></i>
                            <p>{{ __('Точки ресторана') }}</p>
                        </a>
                    </li>
                @endcan
                @can('viewAny', \App\Modules\RestaurantPanel\Restaurant\Models\MenuCategory::class)
                    <li class="nav-item">
                        <a href="{{ route('admin.menu_categories.index') }}" class="nav-link {{ request()->routeIs('admin.menu_categories.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-concierge-bell"></i>
                            <p>{{ __('Категории меню') }}</p>
                        </a>
                    </li>
                @endcan
                @can('viewAny', \App\Modules\RestaurantPanel\Restaurant\Models\Dish::class)
                    <li class="nav-item">
                        <a href="{{ route('admin.dishes.index') }}" class="nav-link {{ request()->routeIs('admin.dishes.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-utensils"></i>
                            <p>{{ __('Блюда') }}</p>
                        </a>
                    </li>
                @endcan
                @can('viewAny', \App\Modules\RestaurantPanel\Orders\Models\Order::class)
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-receipt "></i>
                            <p>{{ __('Заказы') }}</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
