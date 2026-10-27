<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterContrattoInterventoAddTariffaGiornata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contratto_intervento', function (Blueprint $table) {
            //
            $table->integer('tariffa_giornata')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contratto_intervento', function (Blueprint $table) {
            //
            $table->dropColumn('tariffa_giornata');

        });
    }
}
