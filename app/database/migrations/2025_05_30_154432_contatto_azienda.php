<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContattoAzienda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contatto', function (Blueprint $table) {
            //
            $table->string('azienda')->nullable();
            $table->boolean('rifCommerciale');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contatto', function (Blueprint $table) {
            //
            $table->dropColumn('azienda');
            $table->dropColumn('rifCommerciale');
        });
    }
}
