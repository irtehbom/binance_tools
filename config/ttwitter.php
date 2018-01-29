<?php

// You can find the keys here : https://apps.twitter.com/

return [
	'debug'               => function_exists('env') ? env('APP_DEBUG', false) : false,

	'API_URL'             => 'api.twitter.com',
	'UPLOAD_URL'          => 'upload.twitter.com',
	'API_VERSION'         => '1.1',
	'AUTHENTICATE_URL'    => 'https://api.twitter.com/oauth/authenticate',
	'AUTHORIZE_URL'       => 'https://api.twitter.com/oauth/authorize',
	'ACCESS_TOKEN_URL'    => 'https://api.twitter.com/oauth/access_token',
	'REQUEST_TOKEN_URL'   => 'https://api.twitter.com/oauth/request_token',
	'USE_SSL'             => true,

	'CONSUMER_KEY'        => 'fWHaOxcR5QNhiIgfvNunSfvzo',
	'CONSUMER_SECRET'     => 'Uuw80zKUs2EvaXSnwk3KfTYSFSy2ZY3nvGT3NKESfgMyDkrf46',
	'ACCESS_TOKEN'        => '951954913013194754-FHKDHEMUDXfeL3WNEMnckv8UPHuLy9O',
	'ACCESS_TOKEN_SECRET' => '18qIoIXQJHlAKKM5GTxc38Bpq4Q2uJE832cKRZIbdFUxi'
];
