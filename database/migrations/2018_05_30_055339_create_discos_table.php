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
            $table->increments('id');
            $table->string('album', 100);
            $table->string('artista', 150);
            $table->string('capa');
            $table->enum('genero', [
                'Alternativo',
                'Axé',
                'Blues',
                'Bolero',
                'Bossa Nova',
                'Brega',
                'Clássico',
                'Country',
                'Cuarteto',
                'Cumbia',
                'Dance',
                'Disco',
                'Eletrônica',
                'Emocore',
                'Fado',
                'Folk',
                'Forró',
                'Funk',
                'Funk Internacional',
                'Gospel/Religioso',
                'Gótico',
                'Grunge',
                'Guarânia',
                'Hard Rock',
                'Hardcore',
                'Heavy Metal',
                'Hip Hop/Rap',
                'House',
                'Indie',
                'Industrial',
                'Infantil',
                'Instrumental',
                'J-Pop/J-Rock',
                'Jazz',
                'Jovem Guarda',
                'K-Pop/K-Rock',
                'Mambo',
                'Marchas/Hinos',
                'Mariachi',
                'Merengue',
                'MPB',
                'Música andina',
                'New Age',
                'New Wave',
                'Pagode',
                'Pop',
                'Pop Rock',
                'Post-Rock',
                'Power-Pop',
                'Rock Progressivo',
                'Psicodelia',
                'Punk Rock',
                'Ranchera',
                'R&B',
                'Reggae',
                'Reggaeton',
                'Regional',
                'Rock',
                'Rock and Roll',
                'Rockabilly',
                'Romântico',
                'Salsa',
                'Samba',
                'Samba Enredo',
                'Sertanejo',
                'Ska',
                'Soft Rock',
                'Soul',
                'Surf Music',
                'Tango',
                'Tecnopop',
                'Trova',
                'Velha Guarda',
                'World Music',
                'Zamba',
                'Zouk',
            ]);
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
