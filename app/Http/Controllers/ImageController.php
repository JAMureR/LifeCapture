<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\models\Image;

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

}
