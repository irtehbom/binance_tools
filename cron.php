<?php

	require 'vendor/autoload.php';


	use Medoo\Medoo;
	 
	// Initialize
	$database = new Medoo([
		'database_type' => 'mysql',
		'database_name' => 'admin_binance',
		'server' => 'localhost',
		'username' => 'binance',
		'password' => 'vc4D3&v3'
	]);
	 

	$market  = 'XRPETH';
	$api  = 'r2c9Wpogls8FUSg02QLwb8K2JgQgDitFqZzysNQ5qupp2AI9LN3SlHQkNCPo0hm0';
	$secret  = 'oEpEO5v2kZe7a3d4r3Zfvmu26KVMTGLEvPQb6Nsc2IcNiMbi9uSBxaXqM7p3KsQQ';

	$api = new Binance\API($api, $secret);
			
	$prices = $api->prices();


	$bnb = array();
	$btc = array();
	$eth = array();
	$usd = array();


	foreach ($prices as $key => $value) {

		if (preg_match('/BNB/',$key)) {
			array_push($bnb, $key);
		}
		
		if (preg_match('/BTC/',$key)) {
			array_push($btc, $key);
		}
		
		if (preg_match('/ETH/',$key)) {
			array_push($eth, $key);
		}
		
		if (preg_match('/USDT/',$key)) {
			array_push($usd, $key);
		}
		
	}
	
	

	$database->update("pairs", [
			"bnb" => $bnb,
			"btc" => $btc,
			"eth" => $eth,
			"usdt" => $usd
	], [
		"id" => 1
	]);



