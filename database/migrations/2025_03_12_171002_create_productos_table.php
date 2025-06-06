<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    public function up()
{
    Schema::create('productos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->text('descripcion')->nullable();
        $table->string('tipo')->nullable();
        $table->decimal('precio', 8, 2);
        $table->integer('stock');
        $table->string('image')->nullable(); 
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
