<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Models\Image;


Route::get('/', function () {
    return redirect()->route('login');
})->middleware(['auth', 'verified'])->name('dashboard');


//Rutas Generales
// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    //Home
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    //Usuario
    Route::get('/perfil/{id}', [UserController::class, 'profile'])->name('profile');
    Route::get('/personas/{search?}', [UserController::class, 'index'])->name('user.index');

    //Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/user/avatar/{filename}', [ProfileController::class, 'getImage'])->name('user.avatar');

    //Imagen
    Route::get('/subir-imagen', [ImageController::class, 'create'])->name('image.create');
    Route::post('/image/save', [ImageController::class, 'save'])->name('image.save');
    Route::get('/image/file/{filename}', [ImageController::class, 'getImage'])->name('image.file');
    Route::get('/imagen/{id}', [ImageController::class, 'detail'])->name('image.detail');
    Route::get('/image/delete/{id}', [ImageController::class, 'delete'])->name('image.delete');
    Route::get('/image/edit/{id}', [ImageController::class, 'edit'])->name('image.edit');
    Route::post('/image/update', [ImageController::class, 'update'])->name('image.update');

    //Comentarios
    Route::post('/comment/save', [CommentController::class, 'save'])->name('comment.save');
    Route::get('/comment/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');
    Route::get('/like/{image_id}', [LikeController::class, 'like'])->name('like.save');

    //likes
    Route::get('/dislike/{image_id}', [LikeController::class, 'dislike'])->name('like.delete');
    Route::get('/likes', [LikeController::class, 'index'])->name('likes');
    
});

require __DIR__.'/auth.php';
