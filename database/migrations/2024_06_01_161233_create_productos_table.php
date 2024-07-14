<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombre');
            $table->foreignId('categoria_id')->constrained('categorias', 'id_categoria')->onDelete('cascade');
            $table->decimal('precio_venta', 8, 2);
            $table->decimal('precio_compra', 8, 2);
            $table->date('fecha_compra')->nullable();
            $table->string('color');
            $table->string('descripcion_corta');
            $table->text('descripcion_larga');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('productos');
        Schema::enableForeignKeyConstraints();
    }
}
