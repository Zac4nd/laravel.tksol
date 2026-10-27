<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConsulenteRapporto extends Migration
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
            $table->timestamp('data_assunzione')->nullable();
            $table->timestamp('data_cessazione')->nullable();            
            $table->string('rapporto')->nullable();
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
            $table->dropColumn('data_assunzione');
            $table->dropColumn('data_cessazione');            
            $table->dropColumn('rapporto');
        });
    }
}
