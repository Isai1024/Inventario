<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('ventas')) {
            Schema::create('ventas', function (Blueprint $table) {
                $table->id('id_venta');
                $table->foreignId('producto_id')->constrained('productos', 'id_producto')->onDelete('cascade');
                $table->foreignId('categoria_id')->constrained('categorias', 'id_categoria')->onDelete('cascade');
                $table->foreignId('cliente_id')->constrained('clientes', 'id_cliente')->onDelete('cascade');
                $table->foreignId('pago_id')->constrained('formasdepago', 'id')->onDelete('cascade');
                $table->date('fecha_venta');
                $table->decimal('subtotal', 8, 2);
                $table->decimal('iva', 8, 2);
                $table->decimal('total', 8, 2);
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('ventas');
        Schema::enableForeignKeyConstraints();
    }
}
