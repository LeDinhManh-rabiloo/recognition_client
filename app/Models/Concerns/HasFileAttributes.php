<?php

namespace App\Models\Concerns;

use Illuminate\Contracts\Filesystem\Filesystem;
// use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Trait HasFileAttributes
 *
 * @property array $attributes
 */
trait HasFileAttributes
{
    /**
     * Determine if a get mutator exists for an attribute.
     *
     * @param  string  $key
     * @return bool
     */
    abstract public function hasGetMutator($key);

    /**
     * Determine if a set mutator exists for an attribute.
     *
     * @param  string  $key
     * @return bool
     */
    abstract public function hasSetMutator($key);

    /**
     * Determine whether an attribute should be cast to a native type.
     *
     * @param  string  $key
     * @param  array|string|null  $types
     * @return bool
     */
    abstract public function hasCast($key, $types = null);

    /**
     * Get the model's original attribute values.
     *
     * @param  string|null  $key
     * @param  mixed  $default
     * @return mixed|array
     */
    abstract public function getOriginal($key = null, $default = null);

    /**
     * Set a given attribute on the model.
     *
     * @param  string $key
     * @param  mixed $value
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        if ($value instanceof File && !$this->hasSetMutator($key) && $this->isFileCastable($key)) {
            /** @var FilesystemAdapter $fileSystem */
            $fileSystem = $this->getStorageDisk($key);

            // Delete old file
            $oldFile = $this->getOriginal($key);
            if ($fileSystem->has($oldFile)) {
                $fileSystem->delete($oldFile);
            }

            // Save new file and return file path
            $value = $fileSystem->putFile($this->getSavedDirectory($key), $value, 'public');
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Get an attribute from the model.
     *
     * @param  string $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        if (
            strlen($key) > 3 &&
            substr_compare($key, 'Url', -3, 3, true) === 0 &&
            !$this->hasGetMutator($key)
        ) {
            $originalKey = substr($key, 0, -3);
            if ($this->isFileCastable($originalKey) && !empty($this->attributes[$originalKey])) {
                $value = $this->attributes[$originalKey];
                if ($this->shouldUrlGenerate($value)) {
                    return $this->getStorageDisk($key)->url($value);
                } else {
                    return $value;
                }
            }
        }
        return parent::getAttribute($key);
    }

    /**
     * @param  string $key The attribute name
     * @return \Illuminate\Contracts\Filesystem\Filesystem
     */
    public function getStorageDisk(string $key): Filesystem
    {
        return Storage::disk(method_exists($this, 'saveDisk') ? $this->saveDisk($key) : null);
    }

    /**
     * Customize saved directory
     *
     * @param  string $key
     * @return string
     */
    protected function getSavedDirectory(string $key): string
    {
        return 'public/' . strtolower(class_basename($this)) . '/' . $key;
    }

    /**
     * Check field will cast from file
     *
     * @param  string $key
     * @return bool
     */
    protected function isFileCastable(string $key): bool
    {
        return $this->hasCast($key, ['file']);
    }

    /**
     * @param string $value
     * @return bool
     */
    protected function shouldUrlGenerate($value): bool
    {
        // Only start with 'public'
        return strlen($value) > 6 && substr_compare($value, 'public', 0, 6, true) === 0;
    }
}
