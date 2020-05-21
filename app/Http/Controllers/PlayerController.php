<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use App\Http\Requests\SavePlayerRequest;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        $data[] = (object) ['name' => 'Ronaldo', 'position' => 'delantero', 'goals' => 5];
        $data[] = (object) ['name' => 'Zidane', 'position' => 'centro', 'goals' => 2];
        $data[] = (object) ['name' => 'Messi', 'position' => 'centro', 'goals' => 1];

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePlayerRequest $request)
    {
        return "OK";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        return "OK";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        return "OK";
    }
}
