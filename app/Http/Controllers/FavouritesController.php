<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Binance;
use App\Models\Favourites;
use App\Models\News;
use Carbon\Carbon;

class FavouritesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->favourites = new Favourites;
        $this->news = new News;
    }

    public function set(Request $request) {

        $request->user()->authorizeRoles(['Free Lifetime Member','Paying Member', 'Administrator']);

        $userId = Auth::id();
        $user = User::find($userId);
		
		$role = $user->roles()->first();
		$role_id = $role->id;
		
		if ($role_id != 3) {
		
        
        $apiKey = decrypt($user->api_key);
        $apiSecret = decrypt($user->api_secret);

        $fav_data = $user->favourites()->first();

		if (!isset($fav_data['markets']) || $fav_data['markets'] == "") {
			\Session::flash('message', ' <div class="alert alert-danger">Please select your favourites before using the Favourites tab</div>');

			return redirect('admin/settings');
		}

		if ($apiKey == '' || $apiSecret == '') {
			\Session::flash('message', ' <div class="alert alert-danger">Your favourite open orders will only show if you have inputed your API</div>');
		}
		
        
        if (isset($fav_data['market'])) {
            unset($fav_data['market']);
        }
        
        if (isset($fav_data['created_at'])) {
            unset($fav_data['created_at']);
        }
        
        if (isset($fav_data['updated_at'])) {
            unset($fav_data['updated_at']);
        }
        
        if (isset($fav_data['id'])) {
            unset($fav_data['id']);
        }
        
        if (isset($fav_data['user_id'])) {
            unset($fav_data['user_id']);
        }
        
          $decode = json_decode($fav_data['markets']);
        $string = "'" . implode("','", $decode) . "'";
        
       

        return view('admin/favourites/all', [
            'fav_data' => strtolower($string),
            'decode' => $decode
        ]);
		
		} else {
			return;
		}
		
    }

    public function save(Request $request) {

        $input = $request->input();

        if (isset($input['_token'])) {
            unset($input['_token']);
        }

        $userId = Auth::id();
        $user = User::find($userId);

        if (!empty($input)) {

            $favs = array_values($input);
            $flatten_favs = call_user_func_array('array_merge', $favs);

            $favourites = $user->favourites()->firstOrNew(array('user_id' => $userId));
            $favourites->markets = json_encode($flatten_favs);
            $favourites->bnb = isset($input['bnb']) ? json_encode($input['bnb']) : json_encode('[]');
            $favourites->btc = isset($input['btc']) ? json_encode($input['btc']) : json_encode('[]');
            $favourites->eth = isset($input['eth']) ? json_encode($input['eth']) : json_encode('[]');
            $favourites->save();

            \Session::flash('message', ' <div class="alert alert-success">Saved Successfully</div>');
        } else {

            $favourites = $user->favourites()->firstOrNew(array('user_id' => $userId));
            $favourites->markets = '';
            $favourites->bnb = '';
            $favourites->btc = '';
            $favourites->eth = '';
            $favourites->save();
        }

        return redirect('admin/settings');
    }

    public function twitterAjax(Request $request) {

        $request->user()->authorizeRoles(['Free Lifetime Member','Paying Member', 'Administrator']);

        $userId = Auth::id();
        $user = User::find($userId);

        $fav_data = $user->favourites()->first();

        $err = '';

        $tweets = $this->news->getNews($fav_data);
        

        if (is_object($tweets)) {
            $tweets = array();
        }

        if (!isset($tweets)) {
            $err = 'No favourites set';
        }
        
        return $tweets;
    }
    
    public function ordersAjax(Request $request) {

        $request->user()->authorizeRoles(['Free Lifetime Member','Paying Member', 'Administrator']);

        $userId = Auth::id();
        $user = User::find($userId);

        $fav_data = $user->favourites()->first();

        $err = '';

        $trades = $this->favourites->getFavouriteTrades($fav_data, $user);
        
        
        if (is_object($trades)) {
            $trades = array();
        }

        if (!isset($trades)) {
            $err = 'No favourites set';
        }
        
        return $trades;
    }
    
    
            

}
