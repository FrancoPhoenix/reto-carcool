<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'position' => 'required|max:20',
        'goals' => 'required|integer'
    ];

    /**
     * Relations
     */

    /**
     * Get manager relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne('App\Manager', 'id', 'manager_id');
    }

    /**
     * Get league relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function league()
    {
        return $this->hasOne('App\League', 'id', 'league_id');
    }

    /**
     * Get teams relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teams()
    {
        return $this->hasMany('App\PlayerTeam', 'player_id', 'id');
    }

    /**
     * Features
     */

    /**
     * Get all teams with current team or not.
     *
     * @param bool $withCurrent
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getHistoryTeams($withCurrent = false)
    {
        $query = $this->teams();

        if (!$withCurrent) {
            $query->where('current', false);
        }

        return $query->get();
    }
}
