<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class EloquentRepository implements EloquentRepositoryInterface
{

    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param Model $model
     */
    public function __construct(
        Model $model
    ) {
        $this->model = $model;
    }

    /**
     * @return Collection|null
     */
    public function getAll(): ?Collection
    {
        return $this->model->all();
    }

    /**
     * @param array $filters
     * @return Collection|null
     */
    public function getAllByFilters(?array $filters): ?Collection
    {
        return $this->model->where($filters)->get();
    }
}
