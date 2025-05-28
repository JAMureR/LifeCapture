<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
   public function index(Request $request){

         $search = $request->input('search');

        if(!empty($search)){
             $users = User::where('nick','LIKE', '%'.$search.'%')
                            ->orWhere('name', 'LIKE','%'.$search.'%')
                            ->orWhere('surname', 'LIKE','%'.$search.'%')
                            ->orderBy('id','desc') 
                            ->paginate(5);
                                    

        }else{
            $users = User::orderBy('id','desc')->paginate(5);
        }
       

        return view ('user.index', [
            'users' => $users
        ]);
    }
    public function profile($id)
    {
    $user = User::with('images')->findOrFail($id);

    return view('user.profile', compact('user'));
    }

    
}