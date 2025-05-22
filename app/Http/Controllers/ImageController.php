<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\models\Like;
use App\models\Image;
use App\models\Comment;

class ImageController extends Controller
{
    //Restringir acceso a los usuarios identificados 

    public function create()
    {
        return view('image.create');
    }
    public function save(Request $request)
    {
        //validacion
        $request->validate([
            'description' => 'required',
            'image_path' => 'required|image'
        ]);

        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //asignacion de valores a un objeto
        $user = Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        
        $image->description = $description;

        //subir fichero
        if ($image_path) {
            // Crear un nombre único para la imagen
            $image_path_name = time() . $image_path->getClientOriginalName();
            // Guarda el archivo en el disco 'images'
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }
        $image->save();
        return redirect()->route('dashboard')->with(
            'message', 'La foto ha sido subida correctamente.'
        );        
    }

    public function getImage($filename){

        $file = Storage::disk('images')->get($filename);
        return new Response($file,200);

    }

    public function detail($id){
        $image = Image::find($id);

        return view('image.detail',[
            'image' => $image
        ]);
    }


    public function delete($id){
        //Conseguir objeto del usuario identificad
        $user = \Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::Where('image_id', $id)->get();

        if($user && $image && $image->user->id == $user->id){
            //Eliminar comentarios
            if($comments && count($comments) >= 1){
                foreach($comments as $comment){
                    $comment->delete();
                }
            }
        
            //Eliminar likes
            if($likes && count($likes) >= 1){
                foreach($likes as $like){
                    $like->delete();
                }
            }

            //Eliminar imagen
            Storage::disk('images')->delete($image->image_path);

            //Eliminar registro imagen
            $image->delete();

            $message = array ('message' => 'La imagen se ha borrado correctamente');

        }else{
            $message = array ('message' => 'La imagen no se ha borrado');
        }

        return redirect()-> route('dashboard')->with($message);
       
    }

    public function edit($id){

        $user = \Auth::user();
        $image = Image::find($id);

        if($user && $image && $image->user->id == $user->id){
            return view ('image.edit',[
                'image' => $image
            ]);
        }else{
            return redirect()-> route('dashboard');
        }
 

    }
}