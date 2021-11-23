<?php

namespace App\Contracts;

interface FormatInterface
{

    /**
     * @param array|null $data
     * @return mixed
     */
    public function format(?array $data);
}
