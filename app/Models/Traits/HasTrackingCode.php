<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @method Builder newQuery()
 * @method static void creating(\Closure|string|array $callback)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasTrackingCode
{
    public static function bootHasTrackingCode(): void
    {
        static::creating(function (Model $model) {
            if (empty($model->tracking_code)) {
                $model->tracking_code = $model->generateTrackingCode();
            }
        });
    }

    public function generateTrackingCode(): string
    {
        $prefix = $this->trackingPrefix ?? 'REF-';

        do {
            $code = $prefix . random_int(1000000000, 9999999999);
        } while ($this->newQuery()->where('tracking_code', '=', $code)->exists());

        return $code;
    }
}
