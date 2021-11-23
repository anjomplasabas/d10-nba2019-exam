<?php

namespace App\Services\Formats;

use App\Contracts\FormatInterface;

class Json implements FormatInterface
{

    /**
     * @param array|null $data
     * @return mixed
     */
    public function format(?array $data)
    {
        return response()->json($data);
    }
}
