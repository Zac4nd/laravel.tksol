<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContrattoInterventoAddCigOdaDalAl extends Migration
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
            $table->string('ODA',30);
            $table->string('CIG',30);
            $table->timestamp('data_inizio')->nullable();
            $table->timestamp('data_fine')->nullable();
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
            $table->dropColumn('ODA');
            $table->dropColumn('CIG');
            $table->dropColumn('data_inizio');
            $table->dropColumn('data_fine');
        });
    }
}
