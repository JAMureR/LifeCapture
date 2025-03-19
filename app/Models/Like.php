<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table='likes';
    
     //Relacion muchos a uno
     public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

     //Relacion muchos a uno
     public function image(){
        return $this->belongsTo(\App\Models\Image::class, 'image_id');
    }
}
