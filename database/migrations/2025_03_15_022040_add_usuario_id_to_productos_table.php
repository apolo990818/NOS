<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('productos', function (Blueprint $table) {
        $table->unsignedBigInteger('usuario_id')->after('id');
        $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('productos', function (Blueprint $table) {
        $table->dropForeign(['usuario_id']);
        $table->dropColumn('usuario_id');
    });
}

};
