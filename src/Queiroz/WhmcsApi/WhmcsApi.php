<?php namespace Queiroz\WhmcsApi;
use GuzzleHttp\Client;
class WhmcsApi 
{

	public function execute($action, $params)
	{
		
		// Initiate

		$params['username'] 	= \Config::get('whmcs-api::username');
		$params['password'] 	= md5(\Config::get('whmcs-api::password'));
		$params['url'] 			= \Config::get('whmcs-api::url');
		$params['responsetype'] = \Config::get('whmcs-api::responsetype');
		$params['action']		= $action;

		// call curl init connection
		return $this->curl($params);

	}

	public function curl($params)
	{
		// set url
		$url = $params['url'];
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