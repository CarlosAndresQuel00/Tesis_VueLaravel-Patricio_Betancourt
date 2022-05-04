<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->constrained("assignments")->onDelete('cascade');
            $table->string('contrapartida_pay', 100);
            $table->string('entidadfin_pay', 100)->nullable();
            $table->string('evidencia_pay', 100)->nullable();
            $table->datetime('fechapago_pay');
            $table->dateTime('fecharegpago_pay');
            $table->enum('estado_pay', ['Procesado', 'Pendiente']);
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
        Schema::dropIfExists('payments');
    }
}
