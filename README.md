Laravel WHMCS API
=================

Laravel 4 - Simple package for WHMCS external API. It actually forked from https://github.com/queiroz/whmcs-api, but it seems no longer maintained, so i reuse that repo.

Installation
============

Run this to install on your current project

	$ composer require gufy/whmcs:dev-master 

Or you can add this package to your composer.json file:


	"require": {
		"gufy/whmcs": "~1.0"
	}


Use composer to install this package.

	$ composer update

Configuration
=============

#### Registering the Package

register this service provider at the bottom of the $providers array: app.php

	'Gufy\Whmcs\WhmcsServiceProvider'

#### Publish the configuration

When this command is executed, the configuration files for your application will be copied to `app/config/packages/gufy/whmcs` where they can be safely modified by the developer!

	php artisan config:publish gufy/whmcs


#### Setting you API URL

go to laravel/vendor/gufy/whmcs/src/config/config.php and set the parameters


	return array(

		'username'		=>	'api-username',
		'password'		=>	'api-password', // fill these if you want to use username password
		'auth_type'		=> 	'password', // password or api_key
		'url'			=>	'http://www.site.com/whmcs/includes/api.php', // API url
		'responsetype'	=> 'json'
	);


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


Migration Guide
===============

### Service Provider

This package has different namepsace. First of all you should change this


	'Queiroz\WhmcsApi\WhmcsApiServiceProvider'

to

	'Gufy\Whmcs\WhmcsServiceProvider'

### Configuration File

If you already use the old one, first of all, do publish configuration file by doing this on command line
	
	php artisan config:publish gufy/whmcs

And then, copy or move your old configuration from `app/config/packages/queiroz/whmcs-api/config.php` to a new path at `app/config/packages/gufy/whmcs/config.php`

### Dynamic Configuration

If your site has multiple whmcs configuration, you sure will do override configuration like this

	\Config::set('whmcs::url','http://whmcs.site.com/includes/api.php');
	\Config::set('whmcs::password','your_password');
	\Config::set('whmcs::username','your_username');

Please make sure the namespace of your configuration is `whmcs` not `whmcs-api`.

