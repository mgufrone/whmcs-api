<?php namespace Gufy\Whmcs;
use GuzzleHttp\Client;
class Whmcs 
{
	public function execute($action, $params=[])
	{
		
		// Initiate

		$params['username'] 	= \Config::get('whmcs::username');
		$params['responsetype'] = \Config::get('whmcs::responsetype');
		$params['action']		= $action;

		$auth_type = \Config::get('whmcs::auth_type', 'password');

		switch($auth_type)
		{
			case 'api':
			if(false === \Config::has('whmcs::password') || '' === \Config::get('whmcs::password'))
				throw new \Exception("Please provide api key for authentication");
			$params['accesskey'] = \Config::get('whmcs::password');
			break;
			case 'password':
			if(false === \Config::has('password') || '' === \Config::get('password'))
				throw new \Exception("Please provide username password for authentication");
			$params['password'] 	= md5(\Config::get('whmcs::password'));
			break;
		}

		$url = \Config::get('whmcs::url');
		// unset url
		unset($params['url']);

		$client = new Client;
		$response = $client->post($url, ['body'=>$params]);
		
		try
		{
			return json_decode(json_encode($response->json()));
		}
		catch(\GuzzleHttp\Exception\ParseException $e)
		{
			return json_decode(json_encode($response->xml()));
		}

	}

	// using magic method
	public function __call($action, $params)
	{
		return $this->execute($action, $params);
	}

}