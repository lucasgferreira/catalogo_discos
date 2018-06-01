<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disco extends Model
{

    protected $fillable = [
        'album', 'artista', 'genero', 'capa', 'id_user'
    ];
}
