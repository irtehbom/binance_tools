<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Binance;
use App\Models\Favourites;
use Twitter;
use App\Models\NewsSettings;

class News extends Model {

    public function getNews($news_data) {
		
		
		if (!isset($news_data->markets)) {
			\Session::flash('message', ' <div class="alert alert-danger">Please select your favourites below</div>');
            
            return redirect('admin/settings');
		}
                
                       
			

        $fav_markets = json_decode($news_data->markets);
        $remove_prefix = array();
		
		if(isset($fav_markets)) {

        foreach ($fav_markets as $value) {

            if (preg_match('/BTC/', $value)) {
                $data = str_replace('BTC', '', $value);
            }

            if (preg_match('/ETH/', $value)) {
                $data = str_replace('ETH', '', $value);
            }

            if (preg_match('/BNB/', $value)) {
                $data = str_replace('BNB', '', $value);
            }

            if (preg_match('/USDT/', $value)) {
                $data = str_replace('USDT', '', $value);
            }


            array_push($remove_prefix, $data);
        }

        $newsObject = new NewsSettings();

        $newsSettings = $newsObject->first();
        $twitter_settings = json_decode($newsSettings->twitter, true);

        $tweets = array();
        $tweets_data = array();


        foreach ($remove_prefix as $user_selected_markets) {

            if (preg_match('/,/', $twitter_settings[$user_selected_markets])) {

                $multiple = explode(",", $twitter_settings[$user_selected_markets]);

                foreach ($multiple as $multiple_accounts) {
                    
                    

                    if (isset($twitter_settings[$user_selected_markets])) {

                        $tweet = Twitter::getUserTimeline(['screen_name' => $multiple_accounts, 'count' => 2, 'format' => 'array']);
                        $tweets_data['tweet'] = $tweet;
                        $tweets_data['market'] = $user_selected_markets;
                        array_push($tweets, $tweets_data);
                        
                       
                    }
                }
                
            } else {
                
                if (isset($twitter_settings[$user_selected_markets])) {

                    $tweet = Twitter::getUserTimeline(['screen_name' => $twitter_settings[$user_selected_markets], 'count' => 2, 'format' => 'array']);
                    $tweets_data['tweet'] = $tweet;
                    $tweets_data['market'] = $user_selected_markets;
                    array_push($tweets, $tweets_data);
                }
            }
        }
			
			
        return $tweets;
			
			
		}
    }

}
