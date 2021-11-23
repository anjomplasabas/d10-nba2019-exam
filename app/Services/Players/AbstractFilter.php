<?php

namespace App\Services\Players;

use Illuminate\Support\Collection;

abstract class AbstractFilter
{

    /**
     * @var array
     */
    const ALLOWED_FILTERS = [
        'playerId' => 'roster.id',
        'player' => 'roster.name',
        'team' => 'roster.team_code',
        'position' => 'roster.pos',
        'country' => 'roster.nationality'
    ];

    /**
     * @param array|null $requestParameters
     * @return array|null
     */
    protected function parseParameters(?array $requestParameters): ?array
    {
        $filterKeys = array_filter(self::ALLOWED_FILTERS, function ($filter) use ($requestParameters) {
            return in_array($filter, array_flip($requestParameters));
        }, ARRAY_FILTER_USE_KEY);
        
        if (empty($filterKeys)) return null;

        foreach ($filterKeys as $key => $value) {
            $queries[$value] = $requestParameters[$key];
        }
        
        return $queries;
    }

    /**
     * @param array|null $requestParameters
     * @return Collection
     */
    abstract public function fetch(?array $requestParameters): Collection;
}