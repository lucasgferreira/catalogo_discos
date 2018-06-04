<?php

use Illuminate\Database\Seeder;
use App\Models\Artista;

class ArtistaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $artistas = [
            'Slipknot',
            'Linkin Park',
            'Slaughter To Prevail',
            'Metallica',
            '12 Stones',
            'Green Day',
            '3 Doors Down',
            'Marilyn Manson',
            'Disturbed',
            'Red Hot Chili Peppers',
            'Black Sabbath',
            'Five Finger Death Punch',
            'Asking Alexandriaa',
            'Nirvana',
            'Nickelback',
            'Skillet',
            'imagine Dragons',
            'Black Veil Brides',
            'Iron Maiden',
            'Evanescence',
            'Bury Tomorrow',
            'Wage War',
            'Starset',
            'Scorpions',
            'Fear and Wonder',
            'Paramore',
            'System Of A Down',
            'Thousand Foot Krutch'];

        foreach ($artistas as $artista) {

            Artista::create(['nome' => $artista]);
        }
    }
}
