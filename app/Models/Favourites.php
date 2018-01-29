<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Binance;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Crypt;

class Favourites extends Model {

    protected $table = 'favourites';
    protected $fillable = ['markets'];

    public function users() {
        return $this
                        ->belongsTo('App\User', 'id')
                        ->withTimestamps();
    }


    public function getFavouriteTrades($trades, $user) {

        if (isset($trades['market'])) {
            unset($trades['market']);
        }

        $apiKey = decrypt($user->api_key);
        $apiSecret = decrypt($user->api_secret);

        $api = new Binance\API($apiKey, $apiSecret);

        $fav_data = $user->favourites()->first();

        $markets = json_decode($fav_data['markets']);
        $market_history = array();

        if (isset($markets)) {

            $item = array();

            foreach ($markets as $market) {
                $item['market_lower'] = strtolower($market);
                $item['market_higher'] = $market;
                $item['orders'] = array_reverse($api->history($market, 12));
                array_push($market_history, $item);
            }
            
            return $market_history;
        }
    }

}
