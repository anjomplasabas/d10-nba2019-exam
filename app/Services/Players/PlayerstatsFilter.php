<?php

namespace App\Services\Players;

use App\Services\Players\AbstractFilter;
use App\Contracts\Repositories\PlayerRepositoryInterface;
use Illuminate\Support\Collection;

class PlayerstatsFilter extends AbstractFilter
{

    /**
     * @var PlayerRepositoryInterface
     */
    private PlayerRepositoryInterface $playerRepository;

    /**
     * @param PlayerRepositoryInterface $playerRepository
     */
    public function __construct(
        PlayerRepositoryInterface $playerRepository
    ) {
        $this->playerRepository = $playerRepository;
    }

    /**
     * @param array|null $requestParameters
     * @return Collection
     */
    public function fetch(?array $requestParameters): Collection
    {
        return $this->playerRepository->getStatsByFilters(
            $this->parseParameters($requestParameters)
        );
    }
}
