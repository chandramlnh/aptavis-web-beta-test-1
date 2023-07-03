<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;
use App\Models\Club as Clubs;
use App\Models\Matches as Matches;

class Standing extends Component
{
    public $clubs;
    public $matches;

    public function render()
    {

        $this->clubs = DB::table('clubs')
            ->select('clubs.club_name as club_name')
            ->selectRaw('COUNT(matches.id) as tMatch')
            ->selectRaw('SUM(CASE WHEN (matches.club_home_id = clubs.id AND matches.club_home_id < matches.club_away_id) OR (matches.club_away_id = clubs.id AND matches.club_away_id < matches.club_home_id) THEN 1 ELSE 0 END) as win')
            ->selectRaw('SUM(CASE WHEN matches.club_home_id = matches.club_away_id THEN 1 ELSE 0 END) as draw')
            ->selectRaw('SUM(CASE WHEN (matches.club_away_id = clubs.id AND matches.club_away_id > matches.club_home_id) OR (matches.club_home_id = clubs.id AND matches.club_home_id > matches.club_away_id) THEN 1 ELSE 0 END) as lose')
            ->selectRaw('(SELECT SUM(CASE WHEN matches.club_home_id = clubs.id THEN matches.club_home_score ELSE matches.club_away_score END) FROM matches WHERE matches.club_home_id = clubs.id OR matches.club_away_id = clubs.id) as goal_win')
            ->selectRaw('(SELECT SUM(CASE WHEN matches.club_away_id = clubs.id THEN matches.club_home_score ELSE matches.club_away_score END) FROM matches WHERE matches.club_home_id = clubs.id OR matches.club_away_id = clubs.id) as goal_lose')
            ->selectRaw('(SUM(CASE WHEN (matches.club_away_id = clubs.id AND matches.club_away_id < matches.club_home_id) OR (matches.club_home_id = clubs.id AND matches.club_home_id < matches.club_away_id) THEN 3 WHEN matches.club_home_id = matches.club_away_id THEN 1 ELSE 0 END)) as point')
            ->leftJoin('matches', function ($join) {
                $join->on('clubs.id', '=', 'matches.club_home_id')
                    ->orOn('clubs.id', '=', 'matches.club_away_id');
            })
            ->groupBy('clubs.club_name')
            ->orderByDesc('point')
            ->orderByRaw('SUM(matches.club_home_score) - SUM(matches.club_away_score) DESC')
            ->get();

        return view('livewire.standing');
    }
}
