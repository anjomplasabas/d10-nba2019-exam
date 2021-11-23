<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface PlayerRepositoryInterface
{

    /**
     * @param array|null $filters
     * @return Collection
     */
    public function getStatsByFilters(?array $filters): Collection;

    /**
     * @return Collection
     */
    public function getBy3ptShooting(): Collection;
}
