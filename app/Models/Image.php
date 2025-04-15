<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    //Relacion uno a muchos
    public function comments(){
        return $this -> hasMany(\App\Models\Comment::class)->orderBy('id','desc');
    }

     //Relacion uno a muchos
     public function likes(){
        return $this -> hasMany(\App\Models\Like::class);
    }

    //Relacion muchos a uno
    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }


}
