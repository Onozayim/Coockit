<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recetas extends Model
{
    //
    protected $table = 'recetas';

    protected $fillable = [
        'title',
        'body',
        'calories',
        'user_id'
    ];

    protected $hidden = [
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function ingredientes()
    {
        return $this->hasMany('App\Ingredientes', 'receta_id');
    }

    public function enFavoritos()
    {
        return $this->belongsToMany('App\User', 'favoritos', 'user_id', 'reecta_id')
            ->as('en_favoritos')
            ->withTimestamps();
    }

    public function comentarios()
    {
        return $this->hasMany('App\Comentarios', 'receta_id');
    }

    public function rating()
    {
        return $this->hasOne('App\Comentarios', 'receta_id')
            ->selectRaw('receta_id, round(avg(grade), 2) as rate')
            ->groupBy('receta_id');
    }

    public function images()
    {
        return $this->hasMany('App\RecetaPicture', 'receta_id');
    }
}
