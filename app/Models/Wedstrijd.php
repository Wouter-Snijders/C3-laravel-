<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedstrijd extends Model
{
    use HasFactory;

    // Specificeer de naam van de tabel als deze niet de standaard naam is
    protected $table = 'wedstrijden';

    // Zorg ervoor dat de velden die je wilt massaal invullen worden toegestaan
    protected $fillable = [
        'team1_id',
        'team2_id',
        'location',
        'wedstrijd_tijd',
        'scheidsrechter', // Veld voor de naam van de scheidsrechter
    ];

    // Relaties toevoegen voor teams
    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }
}
