<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;

class FrontpageController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $request->user()->authorizeRoles(['Member', 'Administrator', 'Guest','Free Lifetime Member','Paying Member']);

        $user_count = DB::table('users')->count();
        $user_goal = $user_count/1000 * 100;

        return view('front_templates/home', [
            'user_count' => $user_count,
            'user_goal' => $user_goal
        ]);
    }

}
