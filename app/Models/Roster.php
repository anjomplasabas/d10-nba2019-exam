<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_code', 'number', 'name', 'pos', 'height', 'weight', 'dob', 'nationality', 'years_exp', 'college'
    ];

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roster';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function playerTotal()
    {
        return $this->hasOne(PlayerTotal::class, 'player_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_code', 'code');
    }
}
