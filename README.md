TldLang
=======

Laravel 4 - Simple package for WHMCS external API

Installation
============

Add whmcs-api to your composer.json file:


	"require": {
		"queiroz/whmcs-api": "dev-master"
	}


Use composer to install this package.

	$ composer update

Configuration
=============

#### Registering the Package

register this service provider at the bottom of the $providers array: app.php

	'Queiroz\WhmcsApi\WhmcsApiServiceProvider'

#### Setting you API URL

go to laravel/vendor/queiroz/whmcs-api/src/config/config.php and set the parameters


	return array(

		'username'	=>	'api-username',
		'password'	=>	'api-password',
		'url'		=>	'http://www.site.com/whmcs/includes/api.php', // API url

	);

#### Publish the configuration

When this command is executed, the configuration files for your application will be copied to `app/config/packages/queiroz/whmcs-api` where they can be safely modified by the developer!

	php artisan config:publish queiroz/whmcs-api

Usage
=====

#### Basic usage

Logging a user to WHMCS

	$username = 'client';	// Client Username
	$password = 'password'; // Client Password

	$login = Whmcs::execute('validatelogin', array('email' => $username, 'password2' => $password));

	if($login->result == 'success') {
		echo 'User Logged In';
	} elseif($login->result == 'error') {
		echo $login->message;
	}

For reference on WHMCS API please follow [http://docs.whmcs.com/API](http://docs.whmcs.com/API/ "WHMCS API Documentation")
