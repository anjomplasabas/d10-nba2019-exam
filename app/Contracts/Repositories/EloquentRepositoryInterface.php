<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface EloquentRepositoryInterface
{

    /**
     * @return Collection|null
     */
    public function getAll(): ?Collection;

    /**
     * @param array $filters
     * @return Collection|null
     */
    public function getAllByFilters(?array $filters): ?Collection;
}
