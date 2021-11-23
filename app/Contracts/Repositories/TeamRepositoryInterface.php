<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface TeamRepositoryInterface
{

    /**
     * @return Collection
     */
    public function getBy3ptShooting(): Collection;

}