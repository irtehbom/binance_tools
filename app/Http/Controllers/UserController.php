<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function all(Request $request)
    {
        $request->user()->authorizeRoles(['Administrator']);
	
        $users = User::all();

        return view('admin/users/all', [
            'users' => $users
        ]);
    }
}
