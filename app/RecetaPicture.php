<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecetaPicture extends Model
{
    protected $table = 'receta_pictures';

    protected $fillable = [
        'receta_id',
        'path',
        'extension',
        'size'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
