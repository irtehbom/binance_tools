<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Crypt;
use CoinGate\CoinGate;
use App\Models\Orders;
use App\Role;
use App\Models\Secure;

class PaymentController extends Controller {

    public function __construct() {
        $this->secure = new Secure;
    }

    public function getTokenPrice($tokens, $price) {

        $eur_price = 0.33;

        if ($tokens != null) {

            if ($tokens == 360) {

                $price = 42;
                return array(
                    'tokens' => $tokens + 1,
                    'price' => $price
                );
            } else {

                $price = 5;
                return array(
                    'tokens' => $tokens + 1,
                    'price' => $price
                );
            }
        } else {

            if ($price == 5) {
                $tokens = 30;
            } else {
                $tokens = 361;
            }

            return $tokens;
        }
    }

    public function index(Request $request) {

        $params = request()->route()->parameters();
        //$tokens = $request->input('tokens');

        $data = $this->getTokenPrice($params['amount'], null);

        $app_id = "8599";
        $api_key = "rVjfTHtWMylSDo9XB6zkZd";
        $api_secret = "bxN179ZTL2UhsvoHjalt3mEfenu0izCJ";
        $currency = "eur";
        $receive_currency = "eur";
        $token = hash('sha512', 'coingate' . rand());
        $coingate_invoice_id = 'coingate' . rand();

        $o = Orders::create([
                    'user_id' => auth()->id(),
                    'coingate_invoice_id' => $coingate_invoice_id,
                    'token' => $token,
                    'tokens' => $data['tokens'],
                    'total_price' => $data['price'],
                    'status' => 'pending'
        ]);

        $post_params = array(
            'order_id' => $o->id,
            'token' => $token,
            'price' => $data['price'],
            'currency' => $currency,
            'receive_currency' => $receive_currency,
            'callback_url' => 'https://binancetools.com/admin/payments/callback?token=' . $token,
            'cancel_url' => 'https://binancetools.com/admin/cart',
            'success_url' => 'https://binancetools.com/admin/orders',
        );

        $order = \CoinGate\Merchant\Order::create($post_params, array(), array(
                    'live' => 'sandbox',
                    'app_id' => $app_id,
                    'api_key' => $api_key,
                    'api_secret' => $api_secret));

        if ($order) {
            echo $order->status;
            return redirect($order->payment_url);
        } else {
            print_r($order);
        }
    }

    public function callback(Request $request) {

        $order = Orders::find($request->input('order_id'));
        if ($request->input('token') == $order->token) {
            $status = NULL;
            if ($request->input('status') == 'paid') {
                if ($request->input('price') >= $order->total_price) {

                    $status = 'paid';

                    $data = $this->getTokenPrice(null, $request->input('price'));

                    $user = User::find($order->user_id);
                    $tokens = $user->tokens;
                    $user->tokens = $tokens + $data;
                    $user->save();

                    \DB::table('role_user')
                            ->where('user_id', $user->id)
                            ->update(['role_id' => 2]);
                }
            } else {
                $status = $request->input('status');
            }
            if (!is_null($status)) {
                $order->update(['status' => $status]);
            }
        }
    }

    public function orders(Request $request) {

        $user_id = auth()->id();
        $myOrders = Orders::get()->where('user_id', $user_id);

        return view('admin/orders/all', [
            'orders' => $myOrders
        ]);
    }

    public function add(Request $request) {

        return view('admin/orders/add', [
        ]);
    }

    public function freeTrial(Request $request) {

        $security = $this->secure->first();
        $userId = Auth::id();
        $user = User::find($userId);


        if ($user->trial_started == 1) {
            \Session::flash('message', ' <div class="alert alert-error">You have already used up your free trial</div>');
            return redirect('admin/orders/add');
            if (in_array($request->ip(), json_decode($security->ip_address))) {
                \Session::flash('message', ' <div class="alert alert-error">You have already used up your free trial</div>');
                return redirect('admin/orders/add');
                if (in_array($user->email, json_decode($security->emails))) {
                    \Session::flash('message', ' <div class="alert alert-error">You have already used up your free trial</div>');
                    return redirect('admin/orders/add');
                }
            }
        }

        $user->tokens = 7;
        $user->trial_started = 1;
        $user->save();

        \DB::table('role_user')
                ->where('user_id', $user->id)
                ->whereNotIn('role_id', [5, 1])
                ->update(array(
                    'role_id' => 2
        ));
		
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

        \Session::flash('message', ' <div class="alert alert-success">Your free trial has started, we hope you enjoy our software!</div>');

        return redirect('admin/orders/add');
    }

}
