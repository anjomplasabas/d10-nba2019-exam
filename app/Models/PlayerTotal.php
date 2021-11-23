<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerTotal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'player_id',
        'age',
        'game',
        'games_started',
        'minutes_played',
        'field_goals',
        'field_goals_attempted',
        '3pt',
        '3pt_attempted',
        '2pt',
        '2pt_attempted',
        'free_throws',
        'free_throws_attempted',
        'offensive_rebound',
        'defensive_rebound',
        'assists',
        'steals',
        'blocks',
        'turnovers',
        'personal_fouls'
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = null;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function roster()
    {
        return $this->belongsTo(Roster::class, 'player_id', 'id');
    }
}
