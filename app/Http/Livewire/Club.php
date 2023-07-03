<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Club as Clubs;

class Club extends Component
{
    public $clubs, $club_name, $club_city, $clubId, $update = false, $add = false;
 
    protected $rules = [
        'club_name' => 'required|unique:clubs',
        'club_city' => 'required'
    ];
 
    public function resetFields(){
        $this->club_name = '';
        $this->club_city = '';
    }
 
    public function cancel()
    {
        $this->add = false;
        $this->update = false;
        $this->resetFields();
    }
 
    public function render()
    {
        $this->clubs = Clubs::select('id', 'club_name', 'club_city')->get();
        return view('livewire.club');
    }
 
    public function add()
    {
        $this->resetFields();
        $this->add = true;
        $this->update = false;
    }

    public function store()
    {
        $this->validate();
        try {
            Clubs::create([
                'club_name' => $this->club_name,
                'club_city' => $this->club_city
            ]);
            session()->flash('success','Created Successfully!!');
            $this->resetFields();
            $this->add = false;
        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }
    }
 
    public function edit($id){
        try {
            $data = Clubs::findOrFail($id);
            if( !$data) {
                session()->flash('error','Data not found');
            } else {
                $this->club_name = $data->club_name;
                $this->club_city = $data->club_city;
                $this->clubId = $data->id;
                $this->update = true;
                $this->add = false;
            }
        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }
 
    }
 
    public function update()
    {
        $this->validate();
        try {
            Clubs::whereId($this->clubId)->update([
                'club_name' => $this->club_name,
                'club_city' => $this->club_city
            ]);
            session()->flash('success','Updated Successfully!!');
            $this->resetFields();
            $this->update = false;
        } catch (\Exception $ex) {
            session()->flash('success','Something goes wrong!!');
        }
    }

    public function delete($id)
    {
        try{
            Clubs::find($id)->delete();
            session()->flash('success',"Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong!!");
        }
    }
}
