<?php

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categorias = [
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
            'Zouk'
        ];

        foreach ($categorias as $categoria) {

            Categoria::create(['nome' => $categoria]);
        }
    }
}
