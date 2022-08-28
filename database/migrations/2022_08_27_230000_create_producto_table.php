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
        Schema::create('producto', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->id();
            $table->string('nombreProducto', 30)->default('');
            $table->string('descripcion', 100)->default('');
            $table->string('precio', 5)->default('');
            $table->date('fechaCompra');
            $table->enum('estado', ['','Abierto', 'Cerrado'])->default('');
            // Llaves foráneas
            $table->unsignedSmallInteger('idCategoria');
            $table->unsignedSmallInteger('idSucursal');
            $table->unsignedBigInteger('idUsuario');
            $table->foreign('idCategoria')->references('id')->on('catCategoria');
            $table->foreign('idSucursal')->references('id')->on('catSucursal');
            $table->foreign('idUsuario')->references('id')->on('usuario');
            // La fecha de registro va implicito en el timestamps como created_at
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
        Schema::dropIfExists('producto');
    }
};
