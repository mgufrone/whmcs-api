<?php namespace Gufy\Whmcs;
use GuzzleHttp\Client;
class Whmcs 
{
	public function execute($action, $params)
	{
		
		// Initiate

		$params['username'] 	= \Config::get('whmcs::username');
		$params['responsetype'] = \Config::get('whmcs::responsetype');
		$params['action']		= $action;

		$auth_type = \Config::get('whmcs::auth_type', 'auto');

		switch($auth_type)
		{
			case 'auto':
			if(!empty($params['password']))
				$params['password'] 	= md5(\Config::get('whmcs::password'));
			elseif(!empty($params['api_key']))
				$params['accesskey'] = \Config::get('api_key');
			break;
			case 'api':
			if(false === \Config::has('api_key') || '' === \Config::get('api_key'))
				throw new \Exception("Please provide api key for authentication");
			$params['accesskey'] = \Config::get('api_key');
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