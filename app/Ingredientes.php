<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredientes extends Model
{
    //
    protected $table = 'ingredientes';

    protected $fillable = [
        'ingredient',
        'quantity',
        'measurement',
        'receta_id'
    ];

    public function receta()
    {
        return $this->belongsTo('App\Recetas', 'receta_id');
    }
}
