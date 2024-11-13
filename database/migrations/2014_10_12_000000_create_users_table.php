<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // De primaire sleutel voor de gebruiker
            $table->string('name'); // Naam van de gebruiker
            $table->string('email')->unique(); // Unieke email van de gebruiker
            $table->timestamp('email_verified_at')->nullable(); // Tijdstip van email-verificatie
            $table->string('password'); // Wachtwoord van de gebruiker
            $table->rememberToken(); // Token voor het herinneren van de gebruiker bij het inloggen
            $table->enum('rank', ['user', 'teamleider', 'admin'])->default('user'); // Voeg de rank kolom toe (standaard 'user')
            $table->timestamps(); // Timestamps voor aanmaken en bijwerken van de gebruiker
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); // Verwijder de users tabel als de migratie wordt teruggedraaid
    }
};
