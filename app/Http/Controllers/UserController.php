<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
  
    public function profile($id)
    {
    $user = User::with('images')->findOrFail($id);

    return view('user.profile', compact('user'));
    }

    
}