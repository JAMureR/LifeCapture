<?php

namespace App\Http\Controllers;
use App\Models\Image;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    // Obtener todas las imágenes de la base de datos
    $images = Image::orderBy('created_at', 'desc')->paginate(8);

    // Pasar las imágenes a la vista
    return view('dashboard', compact('images'));
}
}
