<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $table = 'plans';

    protected $fillable = [
        'user_id',
        'receta_id',
        'meal',
        'day'
    ];
}
