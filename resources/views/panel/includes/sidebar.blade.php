<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
{{--        <img src="{{ asset('img/logo.svg') }}" alt="logo" class="brand-image">--}}
        <span class="brand-text font-weight-light text-uppercase font-weight-bold">{{ __('Text') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
{{--                                <li class="nav-header">{{ __('Контент') }}</li>--}}

                {{--                <li class="nav-item {{ /*  'menu-open'*/  }}">--}}
                {{--                    <a href="#" class="nav-link {{ (request()->is('home_page/home_block_*') || request()->routeIs('goals.*') || request()->routeIs('statistics.*')) ? 'active' : '' }}">--}}
                {{--                        <i class="nav-icon fas fa-cubes"></i>--}}
                {{--                        <p>--}}
                {{--                            {{ __('titles.home_page') }}--}}
                {{--                            <i class="right fas fa-angle-left"></i>--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('home_page.index', ['id' => 'home_block_1']) }}" class="nav-link {{ request()->is('home_page/home_block_1*') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>{{ __('titles.home_block_1') }}</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('home_page.index', ['id' => 'home_block_2']) }}" class="nav-link {{ request()->is('home_page/home_block_2*') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>{{ __('titles.home_block_2') }}</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('goals.index') }}" class="nav-link {{ (request()->routeIs('goals.*') || request()->is('home_page/home_block_3*') )? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>{{ __('titles.home_block_3') }}</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('statistics.index') }}" class="nav-link {{ (request()->routeIs('statistics.*') || request()->is('home_page/home_block_4*')) ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>{{ __('titles.home_block_4') }}</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}

                @can('viewAny', \App\Modules\Public\RestaurantApplication\Models\RestaurantApplication::class)
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
                <li class="nav-item">
                    <a href="{{ route('admin.restaurant.index') }}" class="nav-link {{ request()->routeIs('admin.restaurant.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-store"></i>
                        <p>{{ __('Ресторан') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.addresses.index') }}" class="nav-link {{ request()->routeIs('admin.addresses.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-map-marker-alt"></i>
                        <p>{{ __('Точки ресторана') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.menu_categories.index') }}" class="nav-link {{ request()->routeIs('admin.menu_categories.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-concierge-bell"></i>
                        <p>{{ __('Категории меню') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.dishes.index') }}" class="nav-link {{ request()->routeIs('admin.dishes.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>{{ __('Блюда') }}</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
