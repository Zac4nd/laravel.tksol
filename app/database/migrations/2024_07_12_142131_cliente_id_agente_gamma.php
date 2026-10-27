<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClienteIdAgenteGamma extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cliente_societa', function (Blueprint $table) {
            //
            $table->string('ID_AGENTE_GAMMA');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cliente_societa', function (Blueprint $table) {
            //
            $table->dropColumn('ID_AGENTE_GAMMA');
        });
    }
}
