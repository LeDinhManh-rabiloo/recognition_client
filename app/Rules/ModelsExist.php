<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ModelsExist implements Rule
{
    /** @var string */
    protected $modelClassName;

    /** @var string */
    protected $primaryKey;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $modelClassName, string $primaryKey = 'id')
    {
        if (!class_exists($modelClassName)) {
            // TODO: Throw exception
        }

        $this->modelClassName = $modelClassName;
        $this->primaryKey = $primaryKey;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  array   $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $modelIds = array_unique(array_filter($value));
        $modelCount = $this->modelClassName::whereIn($this->primaryKey, $modelIds)->count();

        return count($modelIds) === $modelCount;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.models_exist');
    }
}
