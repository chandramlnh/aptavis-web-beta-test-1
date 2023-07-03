<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\Club as Clubs;
use App\Models\Matches as Matches;

class InputScore extends Component
{
    public $clubs;
    public $matches;
    public $club_home_id;
    public $club_home_score;
    public $club_away_id;
    public $club_away_score;
    public $add = false;
    public $addSingle = false;
    public $addMultiple = false;

    public function rules()
    {
        return [
            'club_home_id' => [
                'required',
                'numeric',
                Rule::unique('matches')->where(function ($query) {
                    return $query->where(function ($subquery) {
                        $subquery->where('club_home_id', $this->club_home_id)
                            ->where('club_away_id', $this->club_away_id);
                    })->orWhere(function ($subquery) {
                        $subquery->where('club_home_id', $this->club_away_id)
                            ->where('club_away_id', $this->club_home_id);
                    });
                }),
            ],
            'club_home_score' => 'required|numeric',
            'club_away_id' => [
                'required',
                'numeric',
                Rule::unique('matches')->where(function ($query) {
                    return $query->where(function ($subquery) {
                        $subquery->where('club_home_id', $this->club_home_id)
                            ->where('club_away_id', $this->club_away_id);
                    })->orWhere(function ($subquery) {
                        $subquery->where('club_home_id', $this->club_away_id)
                            ->where('club_away_id', $this->club_home_id);
                    });
                }),
            ],
            'club_away_score' => 'required|numeric',
        ];
    }
 
    public function resetFields(){
        $this->club_home_id = '';
        $this->club_home_score = '';
        $this->club_away_id = '';
        $this->club_away_score = '';
    }
 
    public function cancel()
    {
        $this->add = false;
        $this->resetFields();
    }
 

    public function render()
    {
        return view('livewire.input-score');
    }

    public function add()
    {
        $this->add = true;
    }

    public function addSingle()
    {
        $this->resetFields();

        $this->clubs = Clubs::select('id', 'club_name', 'club_city')->get();

        $this->add = true;
        $this->addSingle = true;
    }
    
    public function storeSingle()
    {
        $this->validate();
        try {
            Matches::create([
                'club_home_id' => $this->club_home_id,
                'club_home_score' => $this->club_home_score,
                'club_away_id' => $this->club_away_id,
                'club_away_score' => $this->club_away_score
            ]);
            session()->flash('success','Created Successfully!!');
            $this->resetFields();
            $this->add = false;
            $this->addSingle = false;
        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }
    }

    public function addMultiple()
    {
        $this->resetFields();
        $this->add = true;
        $this->addMultiple = true;
    }

    public function back()
    {
        $this->add = true;
        $this->addSingle = false;
        $this->addMultiple = false;
    }

}
