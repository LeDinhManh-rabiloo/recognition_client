<?php

namespace App\Models\Concerns;

use Spatie\Sluggable\HasSlug as BaseHasSlug;
use Spatie\Sluggable\SlugOptions;

trait HasSlug
{
    use BaseHasSlug;

    /**
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingSeparator('-')
            ->slugsShouldBeNoLongerThan(100)
            ->doNotGenerateSlugsOnUpdate();
    }
}
