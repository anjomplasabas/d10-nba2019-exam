<?php

namespace App\Services\Formats;

use App\Contracts\FormatInterface;

class Html implements FormatInterface
{

    /**
     * @param array|null $data
     * @return mixed
     */
    public function format(?array $data)
    {
        return view('export', [
            'data' => $data
        ]);
    }
}
