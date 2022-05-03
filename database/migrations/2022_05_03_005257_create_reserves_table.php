<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assig_id')->constrained("assignments")->onDelete('cascade');
            $table->foreignId('ec_id')->constrained("shared_spaces")->onDelete('cascade');
            $table->string('detalle_rsv', 100);
            $table->datetime('fechahi_rsv');
            $table->dateTime('fechahf_rsv');
            $table->enum('estado_rsv', ['Activo', 'Inactivo']);
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
        Schema::dropIfExists('reserves');
    }
}
