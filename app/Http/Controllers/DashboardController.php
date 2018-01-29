<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Secure;

class DashboardController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->secure = new Secure;
    }

    public function index(Request $request) {

        $request->user()->authorizeRoles(['Free Lifetime Member', 'Member', 'Administrator', 'Paying Member']);

        $security = $this->secure->first();

        $userId = Auth::id();
        $user = User::find($userId);
        $user_email = $user->email;

        $emails = json_decode($security->emails);

        $current_ip = $request->ip();
        $stored_ips = json_decode($security->ip_address);
        
        $user->ip_address = $current_ip;

        if (!in_array($user_email, $emails)) {
            array_push($emails, $user_email);
        }

        if (!in_array($current_ip, $stored_ips)) {
            array_push($stored_ips, $current_ip);
        }

        $secure = $security->firstOrNew(array('id' => '1'));
        $secure->ip_address = json_encode($stored_ips);
        $secure->emails = json_encode($emails);
        $secure->save();
        $user->save();

        return view('admin/dashboard');
    }

}
