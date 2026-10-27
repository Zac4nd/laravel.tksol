<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConsulentiSessoDataCdc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consulente', function (Blueprint $table) {
            //
            $table->string('CDC')->nullable();
            $table->timestamp('data_nascita')->nullable();
            $table->enum('sesso', ['Non Specificato','Uomo','Donna']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consulente', function (Blueprint $table) {
            //
            $table->dropColumn('CDC');
            $table->dropColumn('data_nascita');
            $table->dropColumn('sesso');
        });
    }
}
