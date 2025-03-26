<?php

namespace App\Modules\Public\Restaurant\Enums;

enum RestaurantApplicationEnum: string
{
    case PENDING = 'pending';
    case Approved = 'approved';
    case REJECTED = 'rejected';

    public function labels(): string
    {
        return match ($this) {
            self::PENDING => __('В ожидании'),
            self::Approved => __('Одобрено'),
            self::REJECTED => __('Отклонено')
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::Approved => 'success',
            self::REJECTED => 'danger',
        };
    }
}
