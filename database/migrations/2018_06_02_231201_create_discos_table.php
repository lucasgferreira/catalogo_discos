<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('album', 150);
            $table->string('capa');
            $table->integer('id_artista')->unsigned();
            $table->foreign('id_artista')
                ->references('id')->on('artistas')
                ->onDelete('cascade');
            $table->integer('id_categoria')->unsigned();
            $table->foreign('id_categoria')
                ->references('id')->on('categorias')
                ->onDelete('cascade');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')
                ->references('id')->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('discos');
    }
}
