<?php

return array(
	/*
	|--------------------------------------------------------------------------
	| API URL
	|--------------------------------------------------------------------------
	|
	| Full URL to API Access. It includes with /includes/api.php location.
	|
	*/
	'url'		=>	'http://url.com/whmcs/includes/api.php',

	/*
	|--------------------------------------------------------------------------
	| Username
	|--------------------------------------------------------------------------
	|
	| These options is required. you must fill this with username of whmcs account
	| who has API Access or the same access as Full Administrator or Administrator
	|
	*/
	'username'	=>	'username',

	/*
	|--------------------------------------------------------------------------
	| Authentication Type
	|--------------------------------------------------------------------------
	|
	| By default, it will user as api_key either it is using password or api_key.
	| You can set  'api_key' or 'password'.
	|
	*/
	'auth_type'	=>	'password',

	/*
	|--------------------------------------------------------------------------
	| Password or API Key
	|--------------------------------------------------------------------------
	|
	| If your authentication type is password, fill this with your password of
	| username you use in this package. Unless, use API key for authentication
	|
	*/
	'password'	=>	'password',


	/*
	|--------------------------------------------------------------------------
	| Response
	|--------------------------------------------------------------------------
	|
	| Response data you want to receive. It can be as an object or an array
	|
	*/
	'response'=> 'object', // array or object
);
