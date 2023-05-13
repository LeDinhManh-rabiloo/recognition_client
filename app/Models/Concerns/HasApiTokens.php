<?php

namespace App\Models\Concerns;

use Laravel\Passport\HasApiTokens as HasPassportTokens;

trait HasApiTokens
{
    use HasPassportTokens;

    /**
     * Revoke API tokens with the given name.
     *
     * @param  string  $name
     * @return void
     */
    public function revokeTokens($name)
    {
        $this->tokens()->where('name', $name)->update(['revoked' => true]);
    }
}
