<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; // Importar Auth
use App\Models\Comment; 


use Illuminate\Http\Request;

class CommentController extends Controller
{
    //Guardar comentario
    public function save(Request $request){
        //Validación de campos
        $validatedData = $request->validate([
            'image_id' => ['required', 'integer'],
            'content' => ['required', 'string', 'max:500'], // Puedes limitar la cantidad de caracteres
        ]);
        
        //Recoger datos
        $user_id = Auth::id();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        //Asignar valores al nuevo objeto Comment
        $comment = new Comment();
        $comment->user_id = $user_id; 
        $comment->image_id = $image_id;
        $comment->content = $content;
        $comment->save(); // Guardar en la base de datos

        return back()->with('success', 'Comentario guardado correctamente.');
    }

    public function delete($id){
        //Conseguir datos del usuario logueado
        $user=auth::user();

        //Conseguir objeto del comentario
        $comment = Comment::find($id);

        //Comprobar si soy el dueño del comentario o de la publicacion
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
            $comment ->delete();

            return redirect() ->route('image.detail', ['id' => $comment->image->id])
                ->with([
                    'message'=> 'Comentario eliminado.'
                ]);
        }else{
            return redirect() ->route('image.detail', ['id' => $comment->image->id])
                ->with([
                    'message'=> 'No se ha podido eliminar el comentario.'
                ]);

        }

    }



}
