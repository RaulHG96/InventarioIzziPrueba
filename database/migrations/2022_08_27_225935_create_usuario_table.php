<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->id();
            $table->string('nombre', 80)->default('');
            $table->string('apPaterno', 50)->default('');
            $table->string('apMaterno', 50)->default('');
            $table->string('usuario', 30)->unique()->default('');
            $table->string('contrasenia', 80)->default('');
            $table->tinyInteger('acceso')->default(1);
            // Llaves foráneas
            $table->unsignedSmallInteger('idPerfil');
            $table->foreign('idPerfil')->references('id')->on('catPerfil');
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
        Schema::dropIfExists('usuario');
    }
};
