<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateScheidsrechterInWedstrijdenTable extends Migration
{
    public function up()
    {
        Schema::table('wedstrijden', function (Blueprint $table) {
            // Verwijder de bestaande foreign key kolom voor scheidsrechter_id
            $table->dropForeign(['scheidsrechter_id']);
            $table->dropColumn('scheidsrechter_id'); // Verwijder de oude kolom

            // Voeg de nieuwe string kolom toe voor scheidsrechter naam
            $table->string('scheidsrechter');
        });
    }

    public function down()
    {
        Schema::table('wedstrijden', function (Blueprint $table) {
            // Herstel de originele situatie door de kolom weer toe te voegen
            $table->foreignId('scheidsrechter_id')->constrained('users')->onDelete('cascade');
            $table->dropColumn('scheidsrechter'); // Verwijder de naam kolom
        });
    }
}
