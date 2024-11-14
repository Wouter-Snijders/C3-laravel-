<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Wedstrijd extends Model
{
    use HasFactory;

    protected $table = 'wedstrijden'; // Specificeer de tabelnaam

    protected $fillable = [
        'team1_id',
        'team2_id',
        'wedstrijd_tijd',
        'location',
        'score_team1',
        'score_team2',
    ];

    protected $dates = ['wedstrijd_tijd']; // Zorg dat 'wedstrijd_tijd' als datum/tijd wordt behandeld

    // Relatie met team 1
    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    // Relatie met team 2
    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    // Get de datum en tijd van de wedstrijd als een geformatteerde string
    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->wedstrijd_tijd)->format('d-m-Y H:i');
    }
}
