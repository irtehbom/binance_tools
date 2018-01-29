<?php

namespace App\Models\Helpers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pairs;

class Helpers extends Model {
    
    public function __construct() {
        $this->pairs = new Pairs;
    }
    
    public function getPairs() {
        
        $markets = array();
        $item = array();
        
        $pairs = $this->pairs->first();
        
        $eth = json_decode($pairs->eth);
        $btc = json_decode($pairs->btc);
        $bnb = json_decode($pairs->bnb);
        
        sort($eth);
        sort($btc);
        sort($bnb);
        
        $item['market'] = 'eth';
        $item['pairs'] = $eth;
        array_push($markets,$item);
        
        $item['market'] = 'btc';
        $item['pairs'] = $btc;
        array_push($markets,$item);
        
        $item['market'] = 'bnb';
        $item['pairs'] = $bnb;
        array_push($markets,$item);
        
        return $markets;
        
    }
    
}
