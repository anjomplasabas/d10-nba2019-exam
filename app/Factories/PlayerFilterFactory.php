<?php

namespace App\Factories;

use App\Services\Players\AbstractFilter;
use Exception;
use Illuminate\Support\Str;

class PlayerFilterFactory
{

    /**
     * @var string
     */
    const CLASS_LOCATION = '\\App\\Services\\Players\\[CLASS_NAME]';

    /**
     * @var array
     */
    const ALLOWED_TYPES = [
        'players', 'playerstats'
    ];

    /**
     * @param stirng $type
     * @return AbstractFilter
     */
    public function make(?string $type): AbstractFilter
    {
        throw_unless(
            in_array($type, self::ALLOWED_TYPES),
            new Exception('Please specify a type.')
        );

        return app(
            str_replace('[CLASS_NAME]', Str::studly($type).'Filter', self::CLASS_LOCATION)
        );
    }
}
