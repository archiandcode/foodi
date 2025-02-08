<?php

namespace App\Modules\RestaurantPanel\Restaurant\DTOs;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class RestaurantData extends Data
{
    public function __construct(
        public string $name,
        public ?string $description,
        public UploadedFile|string|null $logo,
        public UploadedFile|string|null $banner,
        public ?string $website,
        public string $bin,
    ) {}
}
