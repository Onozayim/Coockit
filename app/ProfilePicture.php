<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilePicture extends Model
{
    //
    protected $table = 'profile_pictures';

    protected $fillable = [
        'user_id',
        'path',
        'extension',
        'size'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
