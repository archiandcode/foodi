<?php

namespace App\Modules\Admin\Restaurants\DTOs;

use App\Modules\Public\Restaurant\Models\RestaurantApplication;
use Illuminate\Support\Str;
use Spatie\LaravelData\Data;

class OwnerData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?string $temp_password,
        public ?int $restaurant_id,
    ) {}

    public static function fromApplication(RestaurantApplication $application, ?int $restaurant_id): self
    {
        $password = Str::random(6);

        return new self(
            name: $application->owner_name,
            email: $application->email,
            password: $password,
            temp_password: $password,
            restaurant_id: $restaurant_id,
        );
    }
}
