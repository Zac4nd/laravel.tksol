<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContrattoTable extends Migration
{

    public function up()
    {
        Schema::create('contratto', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('cliente_id')->unsigned();
            $table->integer('progetto_id')->unsigned();
            $table->enum('stato', ['CONTACT','PROSPECT','FALL','ACTIVE','CLOSED']);
            $table->text('note');
            $table->timestamp('data_primo_contatto');
            $table->timestamp('data_avvio_progetto')->nullable();
            $table->timestamp('data_chiusura_progetto')->nullable();
            $table->enum('modalita_fattura', ['CHIAVI_IN_MANO','TIME_CONSUMING','CANONE']);
            $table->decimal('importo', 10, 2);
            $table->timestamp('data_validita_contratto')->nullable();
            $table->integer('periodicita_pagamenti');
            $table->string('rimborsi', 100);
            $table->integer('societa_id');
            $table->integer('fatturazione_id');
            $table->integer('rapportino');
            $table->integer('ripianifica');
            $table->integer('fatturazione_default');
            $table->string('link_pdf',500);
            $table->string('link_planner',500);
            $table->float('Rimborso_KM',8,2);
            $table->float('Rimborso_Forfait',8,2);
            $table->string('ODA',30);
            $table->string('CIG',30);
            $table->string('desc_breve',50);
            $table->integer('agente_id');
        });
    }

    public function down()
    {
        Schema::drop('contratto');
    }
}
