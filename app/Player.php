<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    const BASE_PATH_DATA  = 'constants/';

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

    /**
     * Get or create file of data players.
     *
     * @return array|mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function getAll()
    {
        $players = Storage::disk('local')->exists(static::BASE_PATH_DATA . 'data.json') ? json_decode(Storage::disk('local')->get('constants/data.json')) : [];

        return $players;
    }

    /**
     * Save all data players
     *
     * @return bool
     */
    public static function saveAll($data)
    {
        return Storage::disk('local')->put(static::BASE_PATH_DATA . 'data.json', json_encode($data));
    }
}
