<?php

namespace App\Factories;

use App\Contracts\FormatInterface;
use Exception;
use Illuminate\Support\Str;

class FormatFactory
{

    /**
     * @var string
     */
    const CLASS_LOCATION = '\\App\\Services\\Formats\\[CLASS_NAME]';

    /**
     * @var array
     */
    const ALLOWED_FORMATS = [
        'xml', 'json', 'csv', 'html'
    ];

    /**
     * @param string|null $type
     * @return FormatInterface
     */
    public function make(?string $type): FormatInterface
    {
        $type = !in_array($type, self::ALLOWED_FORMATS) ? 'html' : $type;
        
        return app(
            str_replace('[CLASS_NAME]', Str::studly($type), self::CLASS_LOCATION)
        );
    }

}