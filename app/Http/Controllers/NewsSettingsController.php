<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Binance;
use App\Models\Favourites;
use App\Models\NewsSettings;

class NewsSettingsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->newsSettings = new NewsSettings;
    }

    public function index(Request $request) {

        $request->user()->authorizeRoles(['Administrator']);

        $apiKey = 'r2c9Wpogls8FUSg02QLwb8K2JgQgDitFqZzysNQ5qupp2AI9LN3SlHQkNCPo0hm0';
        $apiSecret = 'oEpEO5v2kZe7a3d4r3Zfvmu26KVMTGLEvPQb6Nsc2IcNiMbi9uSBxaXqM7p3KsQQ';

        $api = new Binance\API($apiKey, $apiSecret);
        $prices = $api->prices();

        $markets = array();

        foreach ($prices as $key => $value) {

            if (preg_match('/BTC/', $key)) {
                $key = str_replace('BTC', '', $key);
                array_push($markets, $key);
            }
        }

        sort($markets);
        
        $newsSettings = $this->newsSettings->first();
        $twitter = json_decode($newsSettings->twitter);

        return view('admin/news_settings/main', [
            "markets" => $markets,
            'twitter' => $twitter
        ]);
    }

    public function update(Request $request) {

        $input = $request->input();

        if (isset($input['_token'])) {
            unset($input['_token']);
        }
        
        $news =  $this->newsSettings->firstOrNew(array('id' => 1));
        $news->twitter = json_encode($input);
        $news->save();
        
        \Session::flash('message', ' <div class="alert alert-success">Saved Successfully</div>');

        return redirect('admin/news_settings');
        
    }

}
