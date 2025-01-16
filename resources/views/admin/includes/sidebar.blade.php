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
                {{--                <li class="nav-header">{{ __('Контент') }}</li>--}}

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

                {{--                <li class="nav-item">--}}
                {{--                    <a href="#" class="nav-link {{ /* request()->routeIs('') ? 'active' : ''*/ }}">--}}
                {{--                        <i class="nav-icon fas fa-cubes"></i>--}}
                {{--                        <p>{{ __('Ссылка') }}</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}

            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
