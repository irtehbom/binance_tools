<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Settings;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Crypt;
use App\Models\Favourites;
use Binance;
use App\Models\Pairs;
use App\Models\Helpers\Helpers;

class SettingsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->favourites = new Favourites;
        $this->pairs = new Pairs;
        $this->helpers = new Helpers;
    }

    public function index(Request $request) {
        
        
        $request->user()->authorizeRoles(['Free Lifetime Member','Member','Paying Member', 'Administrator']);

        $userId = Auth::id();
        $user = User::find($userId);

        $apiKey = decrypt($user->api_key);
        $apiSecret = decrypt($user->api_secret);
        
        $markets = $this->helpers->getPairs();

        $data = $user->favourites()->first();

        if (!isset($data->markets)) {
            $favourites = array();
        } else {
            $favourites = json_decode($data->markets);
        }
        
        return view('admin/settings/main', [
            'api_key' => $apiKey,
            'api_secret' => $apiSecret,
            'markets' => $markets,
            'favourites' => $favourites
        ]);
    }

    public function save(Request $request) {

        $request->user()->authorizeRoles(['Free Lifetime Member','Member','Paying Member', 'Administrator']);

        $input = $request->input();

        $userId = Auth::id();

        $user = User::find($userId);
        $user->api_key = encrypt($input['api_key']);
        $user->api_secret = encrypt($input['api_secret']);
        $user->save();

        \Session::flash('message', ' <div class="alert alert-success">API Credentials Saved and Encrypted</div>');

        return redirect('admin/settings');
    }

}
