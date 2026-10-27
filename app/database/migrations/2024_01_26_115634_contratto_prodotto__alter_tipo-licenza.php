<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;

class ContrattoProdottoAlterTipoLicenza extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contratto_prodotto', function (Blueprint $table) {
            //
            DB::statement("ALTER TABLE contratto_prodotto MODIFY COLUMN tipo_vendita ENUM('LICENZA', 'NOLEGGIO', 'CANONE', 'TRY')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contratto_prodotto', function (Blueprint $table) {
            //
            DB::statement("ALTER TABLE contratto_prodotto MODIFY COLUMN tipo_vendita ENUM('LICENZA', 'NOLEGGIO')");
        });
    }
}
