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
        $players = Player::getAll();

        return $players;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePlayerRequest $request)
    {
        try {
            $players = Player::getAll();
            $inputData = $request->only(['name', 'position', 'goals']);
            $inputData['created_at'] = date('Y-m-d H:i:s');

            if (!count($players)) {
                $players = [];
            }

            $players[] = $inputData;

            Player::saveAll($players);

            return $inputData;
        } catch(Exception $e) {
            return ['error' => true, 'message' => $e->getMessage()];
        }
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
        try {
            $players = Player::getAll();
            $inputData = $request->only(['name', 'position', 'goals']);
            $inputData['updated_at'] = date('Y-m-d H:i:s');

            //TODO: update specific player

            return $inputData;
        } catch(Exception $e) {
            return ['error' => true, 'message' => $e->getMessage()];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        //TODO: delete specific player

        return "OK";
    }
}
