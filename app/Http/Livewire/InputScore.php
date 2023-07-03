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
    public $newMatch = [];
    public $add = false;
    public $addSingle = false;
    public $addMultiple = false;

    public function rules()
    {
        return [
            'club_home_id' => [
                'required',
                'integer',
                'exists:clubs,id',
                Rule::unique('matches')->where(function ($query) {
                    return $query->where(function ($subquery) {
                        $subquery->where('club_home_id', $this->club_home_id)
                            ->where('club_away_id', $this->club_away_id);
                    })->orWhere(function ($subquery) {
                        $subquery->where('club_home_id', $this->club_away_id)
                            ->where('club_away_id', $this->club_home_id);
                    });
                }),
                function ($attribute, $value, $fail) {
                    if ($value == $this->club_away_id) {
                        $fail('Home and Away cannot be the same.');
                    }
                },
            ],
            'club_home_score' => 'required|numeric',
            'club_away_id' => [
                'required',
                'integer',
                'exists:clubs,id',
                function ($attribute, $value, $fail) {
                    if ($value == $this->club_home_id) {
                        $fail('Home and Away cannot be the same.');
                    }
                    if ($this->club_home_id > $value) {
                        $fail('The match between team one and team two has been recorded.');
                    }
                },
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
        $this->matches = Matches::join('clubs as home', 'matches.club_home_id', '=', 'home.id')
                        ->join('clubs as away', 'matches.club_away_id', '=', 'away.id')
                        ->select('matches.id', 'home.club_name as club_home_name', 'matches.club_home_score', 'away.club_name as club_away_name', 'matches.club_away_score')
                        ->get();

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

    public function validateAddMultiple()
    {
        $rules = [];

        foreach ($this->newMatch as $index => $match) {
            $rules["newMatch.{$index}.club_home_id"] = 'required|distinct|not_in:'.$this->getClubMatches($match['club_away_id']);
            $rules["newMatch.{$index}.club_away_id"] = 'required|distinct|different:newMatch.'.$index.'.club_home_id|not_in:'.$this->getClubMatches($match['club_home_id']);

            for ($i = 0; $i < $index; $i++) {
                $rules["newMatch.{$index}.club_home_id"] .= '|different:newMatch.'.$i.'.club_home_id,newMatch.'.$i.'.club_away_id';
                $rules["newMatch.{$index}.club_away_id"] .= '|different:newMatch.'.$i.'.club_home_id,newMatch.'.$i.'.club_away_id';
            }
        }

        $rules["newMatch.*.club_home_score"] = 'required|numeric';
        $rules["newMatch.*.club_away_score"] = 'required|numeric';

        $validatedData =  $this->validate($rules, [
            'newMatch.*.club_home_id.required' => 'The Home Club is required.',
            'newMatch.*.club_home_id.distinct' => 'The Home Club cannot be the same.',
            'newMatch.*.club_home_id.different' => 'The Home Club must be different from the Away Club.',
            'newMatch.*.club_home_id.not_in' => 'The Home Club have met in previous fixtures.',
            'newMatch.*.club_away_id.required' => 'The Away Club is required.',
            'newMatch.*.club_away_id.distinct' => 'The Away Club cannot be the same.',
            'newMatch.*.club_away_id.different' => 'The Away Club must be different from the Home Club.',
            'newMatch.*.club_away_id.not_in' => 'The Away Club have met in previous clashes.',
            'newMatch.*.club_home_score.required' => 'The Home Club is required.',
            'newMatch.*.club_away_score.required' => 'The Away Club is required.',
            'newMatch.*.club_home_score.numeric' => 'The Home Score field validation must have a numeric value.',
            'newMatch.*.club_away_score.numeric' => 'The Away Score field validation must have a numeric value.',
        ]);

        return $validatedData;
    }

    private function getClubMatches($clubId)
    {
        $matches = Matches::where('club_home_id', $clubId)
                    ->orWhere('club_away_id', $clubId)
                    ->get();

        $clubMatches = $matches->flatMap(function ($match) use ($clubId) {
            return [
                $match->club_home_id,
                $match->club_away_id,
            ];
        });

        $clubMatches = $clubMatches->reject(function ($match) use ($clubId) {
            return $match == $clubId;
        });

        return $clubMatches->implode(',');
    }

    public function addMultiple()
    {
        $this->resetFields();

        $this->clubs = Clubs::select('id', 'club_name', 'club_city')->get();

        $this->add = true;
        $this->addMultiple = true;
    }

    public function addMatch()
    {
        $this->newMatch[] = [
            'club_home_id' => null,
            'club_home_score' => null,
            'club_away_id' => null,
            'club_away_score' => null,
        ];
    }

    public function storeMultiple()
    {
        $this->validateAddMultiple();
        foreach ($this->newMatch as $match) {
            Matches::create($match);
        }
        $this->newMatch = [];
        $this->add = false;
        $this->addMultiple = false;
    }

    public function removeMatch($index)
    {
        unset($this->newMatch[$index]);
        $this->newMatch = array_values($this->newMatch);
    }

    public function back()
    {
        $this->add = true;
        $this->addSingle = false;
        $this->addMultiple = false;
    }

    public function delete($id)
    {
        try{
            Matches::find($id)->delete();
            session()->flash('success',"Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong!!");
        }
    }

}
