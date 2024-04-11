<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comentarios extends Model
{
    //
    protected $table = 'comentarios';

    protected $fillable = [
        'comment',
        'grade',
        'user_id',
        'receta_id'
    ];

    public static function checkIfUserHasComment($id)
    {
        return Comentarios::where('user_id', Auth::id())->where('receta_id', $id)->exists();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function receta()
    {
        return $this->belongsTo('App\Recetas', 'receta_id');
    }

}
