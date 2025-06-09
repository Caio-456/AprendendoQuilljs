<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mineral extends Model
{

    protected $fillable = [
        'id',
        'titulo',
        'descricao',
    ];
    public function fotos(){
        return $this->hasMany(Fotos::class, 'idPostagem' );
    }

}