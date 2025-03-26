<?php

namespace App\Modules\Public\Orders\DTOs;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CreateOrderData extends Data
{
    public function __construct(
        public int      $restaurant_id,
        public int|null $user_id,

        #[DataCollectionOf(CreateOrderItemData::class)]
        public DataCollection $dishes,

        public ?OrderAddressData $address,
    ) {}
}
