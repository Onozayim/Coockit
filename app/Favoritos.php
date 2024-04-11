<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favoritos extends Model
{
    //
    protected $table = 'favoritos';

    protected $fillable = [
        'user_id',
        'receta_id'
    ];

    static public function checkIfUserHasFavorite($receta_id) {
        return Favoritos::where('user_id', Auth::id())->where('receta_id', $receta_id)->exists();
    }

    public function receta() {
        return $this->belongsTo('App\Recetas', 'receta_id');
    }
}

