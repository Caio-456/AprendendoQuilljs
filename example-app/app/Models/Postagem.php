<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postagem extends Model
{
    protected $fillable = [
        'id',
        'titulo',
        'descricao',
    ];
}