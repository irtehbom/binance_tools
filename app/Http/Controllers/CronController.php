<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Settings;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Crypt;
use App\Models\Pairs;
use Binance;

class CronController extends Controller {

    public function __construct() {
        $this->pairs = new Pairs;
    }

    public function index() {

        $user = User::find(1);

        $apiKey = decrypt($user->api_key);
        $apiSecret = decrypt($user->api_secret);

        $api = new Binance\API($apiKey, $apiSecret);

        $prices = $api->prices();

        $bnb = array();
        $btc = array();
        $eth = array();

        foreach ($prices as $key => $value) {

            if (preg_match('/BNB/', $key)) {
                array_push($bnb, $key);
            }

            if (preg_match('/BTC/', $key)) {
                array_push($btc, $key);
            }

            if (preg_match('/ETH/', $key)) {
                array_push($eth, $key);
            }
        }


        $pairs = $this->pairs->firstOrNew(array('id' => 1));
        $pairs->bnb = json_encode($bnb);
        $pairs->btc = json_encode($btc);
        $pairs->eth = json_encode($eth);
        $pairs->save();
    }

    public function paymentDays() {

        \DB::table('users')
                ->where('tokens', '>', 0)
                ->update(array(
                    'tokens' => \DB::raw('tokens - 1')
        ));

        $users = User::where('tokens', '<', 1)->get();
        
        foreach ($users as $user) {

            \DB::table('role_user')
                    ->where('user_id', $user->id)
                    ->whereNotIn('role_id', [5,1])
                    ->update(array(
                        'role_id' => 3
            ));
            
        }
    }

}
