<?php

namespace App\Services\Csp\Policies;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Basic as Policy;

class Basic extends Policy
{
    public function configure()
    {
        parent::configure();

        $this->addDirective(Directive::IMG, '*')
            ->addDirective(Directive::SCRIPT, [
                'self',
                'cdnjs.cloudflare.com'
            ])
            ->addDirective(Directive::STYLE, [
                'self',
                'cdnjs.cloudflare.com',
                'fonts.googleapis.com'
            ])
            ->addDirective(Directive::FONT, [
                'self',
                'fonts.gstatic.com'
            ]);
    }
}
