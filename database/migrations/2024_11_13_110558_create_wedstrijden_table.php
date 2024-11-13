<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// database/migrations/xxxx_xx_xx_create_wedstrijden_table.php

public function up()
{
    Schema::create('wedstrijden', function (Blueprint $table) {
        $table->id();
        $table->foreignId('team1_id')->constrained('teams')->onDelete('cascade');
        $table->foreignId('team2_id')->constrained('teams')->onDelete('cascade');
        $table->dateTime('wedstrijd_tijd');
        $table->string('location');
        $table->timestamps();
    });
}
