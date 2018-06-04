<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disco extends Model
{

    protected $fillable = [
        'album', 'capa', 'id_user', 'id_artista', 'id_categoria'
    ];
}
