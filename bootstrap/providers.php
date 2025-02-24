<?php


return [
    App\Providers\AppServiceProvider::class,
    App\Modules\Admin\Location\Providers\LocationServiceProvider::class,
    App\Modules\Public\Carts\Providers\CartServiceProvider::class,
    App\Modules\Public\Restaurant\Providers\RestaurantServiceProvider::class,
];
