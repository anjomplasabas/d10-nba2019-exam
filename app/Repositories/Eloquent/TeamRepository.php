<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\TeamRepositoryInterface;
use App\Models\Team;
use Illuminate\Support\Collection;
use App\Repositories\Eloquent\EloquentRepository;
use Illuminate\Support\Facades\DB;

class TeamRepository extends EloquentRepository implements TeamRepositoryInterface
{

    /**
     * @param Team $model
     */
    public function __construct(
        Team $model
    ) {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function getBy3ptShooting(): Collection
    {
        $teams = $this->model
            ->select(
                'team.name',
                DB::raw('ROUND(( SUM(player_totals.3pt) / SUM(player_totals.3pt_attempted) * 100 ),2) as 3pt_percentage'),
                DB::raw('SUM(player_totals.3pt) as 3pt'),
                DB::raw('COUNT(IF(player_totals.3pt > 0, player_totals.player_id, null)) as players_made_3pts'),
                DB::raw(
                    'COUNT(IF(player_totals.3pt_attempted > 0, player_totals.player_id, null)) as players_attempted_3pts'
                ),
                DB::raw(
                    'SUM(IF((player_totals.3pt = 0 AND player_totals.3pt_attempted > 0), player_totals.3pt_attempted, null)) as faield_3pts'
                )
            )
            ->leftJoin('roster', 'roster.team_code', '=', 'team.code')
            ->leftJoin('player_totals', 'player_totals.player_id', '=', 'roster.id')
            ->groupBy('name')
            ->orderBy('3pt_percentage', 'DESC');
            
        return $teams->get();
    }
}
