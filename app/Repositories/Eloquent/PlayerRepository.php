<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\PlayerRepositoryInterface;
use App\Models\PlayerTotal;
use App\Models\Roster;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PlayerRepository extends EloquentRepository implements PlayerRepositoryInterface
{

    /**
     * @var PlayerTotal
     */
    private PlayerTotal $playerTotal;

    /**
     * @param PlayerTotal $playerTotal
     * @param Roster $model
     */
    public function __construct(
        PlayerTotal $playerTotal,
        Roster $model
    ) {
        parent::__construct($model);

        $this->playerTotal = $playerTotal;
    }

    /**
     * @param array|null $filters
     * @return Collection
     */
    public function getStatsByFilters(?array $filters): Collection
    {
        $players = $this->playerTotal
            ->select(
                'roster.name',
                'player_totals.age',
                'player_totals.games',
                'player_totals.games_started',
                'player_totals.minutes_played',
                'player_totals.field_goals',
                'player_totals.field_goals_attempted',
                'player_totals.3pt',
                'player_totals.3pt_attempted',
                'player_totals.2pt',
                'player_totals.2pt_attempted',
                'player_totals.free_throws',
                'player_totals.free_throws_attempted',
                'player_totals.offensive_rebounds',
                'player_totals.defensive_rebounds',
                'player_totals.assists',
                'player_totals.steals',
                'player_totals.blocks',
                'player_totals.turnovers',
                'player_totals.personal_fouls'
            )
            ->join('roster', 'roster.id', '=', 'player_totals.player_id');
        
        if ($filters) {
            $players->where($filters);
        }

        return $players->get();
    }

    /**
     * @return Collection
     */
    public function getBy3ptShooting(): Collection
    {
        $players = $this->model
            ->select(
                'roster.name as player_name',
                'team.name as full_team_name',
                DB::raw('TIMESTAMPDIFF(YEAR, roster.dob , CURDATE()) AS age'),
                'roster.number as player_number',
                'roster.pos as position',
                DB::raw('ROUND(( player_totals.3pt / player_totals.3pt_attempted * 100 ),2) as 3pt_percentage'),
                'player_totals.3pt as 3pt_made',
            )
            ->leftJoin('player_totals', 'player_totals.player_id', '=', 'roster.id')
            ->leftJoin('team', 'team.code', '=', 'roster.team_code')
            ->having('3pt_percentage', '>', 35)
            ->having('age', '>', 30)
            ->orderBy('3pt_percentage', 'DESC');
        
        return $players->get();
    }
    
}