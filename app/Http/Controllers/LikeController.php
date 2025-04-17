<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Like;


class LikeController extends Controller
{
    
    public function like ($image_id){
        //Recoger datos del usuario
        $user = Auth::user();

        //Condicion para ver si existe like
        $isset_like = Like::where('user_id', $user->id)
                            ->where('image_id',$image_id)
                            -> count();
       
        if($isset_like == 0){
            $like = new Like();
            $like -> user_id = $user->id;
            $like -> image_id = (int)$image_id;

            //Guardar
            $like->save();
            return response()->json([
                'like' => $like
            ]);

        }else{
            return response()->json([
                'message' => 'El like ya existe'
            ]);
        }
    }

    public function dislike ($image_id){
        //Recoger datos del usuario
        $user = Auth::user();

        //Condicion para ver si existe like
        $like = Like::where('user_id', $user->id)
                            ->where('image_id',$image_id)
                            -> first();
       
        if($like){
            //Eliminar like
            $like->delete();
            return response()->json([
                'like' => $like,
                'message' => 'has dado dislike '
            ]);

        }else{
            return response()->json([
                'message' => 'El like no existe'
            ]);
        }
    }

}
