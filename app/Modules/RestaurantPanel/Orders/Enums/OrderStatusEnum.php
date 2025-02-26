<?php

namespace App\Modules\RestaurantPanel\Orders\Enums;

enum OrderStatusEnum: string
{
    case PENDING = 'pending';
    case CANCELLED = 'cancelled';
    case COOKING = 'cooking';
    case SHIPPED = 'shipped';

    public function labels(): string
    {
        return match ($this) {
            self::PENDING => __('Pending'),
            self::CANCELLED => __('Cancelled'),
            self::COOKING => __('Cooking'),
            self::SHIPPED => __('Shipped'),
        };
    }

}
