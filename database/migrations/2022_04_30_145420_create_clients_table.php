<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('identificacion_cli');
            $table->string('nombres_cli');
            $table->string('apellidos_cli');
            $table->string('empresa_cli');
            $table->text('direccion_cli');
            $table->string('email_cli')->unique();
            $table->string('telf_cli');
            $table->string('tipo_cli')->default('Titular');
            $table->string('estado_cli')->default('Activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
