<?php

namespace App\Models\Concerns;

/**
 * Prevent Update trait
 *
 * Some times you want to prevent update on any model, for this purpose you can use this trait
 */
trait ShouldImmutable
{
    /**
     * Booting trait function
     *
     * @return void
     */
    public static function bootShouldImmutable()
    {
        static::updating(function ($model) {
            return false;
        });
    }
}
