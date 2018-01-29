<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Settings;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Crypt;
use App\Models\Favourites;
use TorControl;
use Middleware;
use GuzzleHttp\Client;
use Binance;

class TestController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->favourites = new Favourites;
    }

    public function index(Request $request) {
        
        $userId = Auth::id();
        $user = User::find($userId);

        $apiKey = decrypt($user->api_key);
        $apiSecret = decrypt($user->api_secret);
        
        $api = new Binance\API($apiKey, $apiSecret);

        
        $response = $this->apiRequest("v1/userDataStream", "POST");
        

        $balance_update = function($api, $balances) {
            print_r($balances);
            echo "Balance update" . PHP_EOL;
        };

        $order_update = function($api, $report) {
            echo "Order update" . PHP_EOL;
            print_r($report);
            $price = $report['price'];
            $quantity = $report['quantity'];
            $symbol = $report['symbol'];
            $side = $report['side'];
            $orderType = $report['orderType'];
            $orderId = $report['orderId'];
            $orderStatus = $report['orderStatus'];
            $executionType = $report['orderStatus'];
            if ($executionType == "NEW") {
                if ($executionType == "REJECTED") {
                    echo "Order Failed! Reason: {$report['rejectReason']}" . PHP_EOL;
                }
                echo "{$symbol} {$side} {$orderType} ORDER #{$orderId} ({$orderStatus})" . PHP_EOL;
                echo "..price: {$price}, quantity: {$quantity}" . PHP_EOL;
                return;
            }
            //NEW, CANCELED, REPLACED, REJECTED, TRADE, EXPIRED
            echo "{$symbol} {$side} {$executionType} {$orderType} ORDER #{$orderId}" . PHP_EOL;
        };
        $api->userData($balance_update, $order_update);

    }

}
