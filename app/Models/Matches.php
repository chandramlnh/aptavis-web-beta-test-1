<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;
    protected $table = 'matches';
    protected $fillable = [
        'club_home_id', 'club_home_score', 'club_away_id', 'club_away_score', 
    ];
    public $timestamps = true;
}
