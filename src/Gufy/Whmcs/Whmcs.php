<?php namespace Gufy\Whmcs;
use GuzzleHttp\Client;
class Whmcs 
{
	public function execute($action, $params)
	{
		
		// Initiate

		$params['username'] 	= \Config::get('whmcs::username');
		$params['password'] 	= md5(\Config::get('whmcs::password'));
		$params['responsetype'] = \Config::get('whmcs::responsetype');
		$params['action']		= $action;

		// call curl init connection
		// set url
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