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
            $table->string('identificacion_cli', 15);
            $table->string('nombres_cli', 100);
            $table->string('apellidos_cli', 100);
            $table->string('empresa_cli', 100);
            $table->string('direccion_cli', 300);
            $table->string('email_cli', 100);
            $table->string('telf_cli', 20);
            $table->enum('tipo_cli', ['Titular', 'Asociado']);
            $table->enum('estado_cli', ['Activo', 'Inactivo']);
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
