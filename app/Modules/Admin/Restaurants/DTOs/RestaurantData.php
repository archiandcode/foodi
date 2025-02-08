<?php

namespace App\Modules\Admin\Restaurants\DTOs;

use App\Modules\Public\RestaurantApplication\Models\RestaurantApplication;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class RestaurantData extends Data
{
    public function __construct(
        public string $name,
        public ?string $description,
        public UploadedFile|string|null $logo,
        public UploadedFile|string|null $banner,
        public bool $is_banned,
        public ?string $website,
        public string $bin,
    ) {}

    public static function fromApplication(RestaurantApplication $application): self
    {
        return new self(
            name: $application->name,
            description: $application->description,
            logo: null,
            banner: null,
            is_banned: false,
            website: $application->website,
            bin: $application->bin,
        );
    }
}
