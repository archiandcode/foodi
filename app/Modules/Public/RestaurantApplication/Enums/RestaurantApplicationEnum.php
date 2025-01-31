<?php

namespace App\Modules\Public\RestaurantApplication\Enums;

enum RestaurantApplicationEnum: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';

    public function labels(): string
    {
        return match ($this) {
            self::Pending => __('В ожидании'),
            self::Approved => __('Одобрено'),
            self::Rejected => __('Отклонено')
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Approved => 'success',
            self::Rejected => 'danger',
        };
    }
}
