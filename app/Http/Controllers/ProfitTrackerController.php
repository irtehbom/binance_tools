<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Binance;
use App\Models\Helpers\Helpers;

class ProfitTrackerController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->helpers = new Helpers;
    }

    public function index(Request $request) {

        $request->user()->authorizeRoles(['Free Lifetime Member','Paying Member', 'Administrator','Member']);

        $userId = Auth::id();
        $user = User::find($userId);
        
        $apiKey = decrypt($user->api_key);
        $apiSecret = decrypt($user->api_secret);

        if ($apiKey == '' || $apiSecret == '') {
             \Session::flash('message', ' <div class="alert alert-danger">Please input your API key before using any tools</div>');
            
            return redirect('admin/settings');
        }
        
        $markets = $this->helpers->getPairs();

        return view('admin/ProfitTracker/main', [
            'markets' => $markets
        ]);
    }

    public function ajax(Request $request) {

        $request->user()->authorizeRoles(['Free Lifetime Member','Paying Member', 'Administrator','Member']);

        $input = $request->input();
        $market = $input['market'];
        
        $userId = Auth::id();
        $user = User::find($userId);

        $apiKey = decrypt($user->api_key);
        $apiSecret = decrypt($user->api_secret);

        $api = new Binance\API($apiKey, $apiSecret);
        
        $history = array_reverse($api->history($market, 25));
        $data = array();

        if (isset($history)) {

            foreach ($history as $history_orders) {

                $item = array();

                $seconds = $history_orders['time'] / 1000;
                $date_convert = date("d/m/Y H:i:s", $seconds);

                $order = $history_orders['price'];
                $checkType = $history_orders['isBuyer'];
                $qty = $history_orders['qty'];
                $date = $date_convert;

                if ($checkType) {
                    $type = 'Buy Order';
                } else {
                    $type = 'Sell Order';
                }

                $item['market_lower'] = strtolower($market);
                $item['market_higher'] = $market;
                $item['order'] = $order;
                $item['qty'] = $qty;
                $item['type'] = $type;
                $item['date'] = $date;

                array_push($data, $item);
            }
            
            return $data;
            
        }
    }

}
