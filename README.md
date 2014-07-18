WHMCS-API
=======

Laravel 4 - Simple package for WHMCS external API. It actually forked from https://github.com/queiroz/whmcs-api, but it seems no longer maintained, so i reuse that repo.

Installation
============

Run this to install on your current project

	$ composer require gufy/whmcs:dev-master 

Or you can add this package to your composer.json file:


	"require": {
		"gufy/whmcs": "dev-master"
	}


Use composer to install this package.

	$ composer update

Configuration
=============

#### Registering the Package

register this service provider at the bottom of the $providers array: app.php

	'Queiroz\WhmcsApi\WhmcsApiServiceProvider'

#### Setting you API URL

go to laravel/vendor/gufy/whmcs/src/config/config.php and set the parameters


	return array(

		'username'		=>	'api-username',
		'password'		=>	'api-password',
		'url'			=>	'http://www.site.com/whmcs/includes/api.php', // API url
		'responsetype'	=> 'json'
	);

#### Publish the configuration

When this command is executed, the configuration files for your application will be copied to `app/config/packages/gufy/whmcs` where they can be safely modified by the developer!

	php artisan config:publish gufy/whmcs

Usage
=====

#### Basic usage

Logging a user to WHMCS

	$username = 'client';	// Client Username
	$password = 'password'; // Client Password

	$login = Whmcs::execute('validatelogin', array(
		'email' => $username, 
		'password2' => $password
	));

	// or

	$login = Whmcs::validatelogin(array(
		'email' => $username, 
		'password2' => $password
	));

	if($login->result == 'success') {
		echo 'User Logged In';
	} elseif($login->result == 'error') {
		echo $login->message;
	}

For reference on WHMCS API please follow [http://docs.whmcs.com/API](http://docs.whmcs.com/API/ "WHMCS API Documentation")
