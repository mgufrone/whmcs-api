<?php namespace Gufy\Whmcs;
use GuzzleHttp\Client;
use Config;
use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ParseException;
class Whmcs
{
	public static function execute($action, $params=[])
	{

		// Initiate

		$params['username'] 	= config('whmcs.username');
		$params['responsetype'] = config('whmcs.responsetype','json');
		$params['action']		= $action;

		$auth_type = config('whmcs.auth_type', 'password');

		switch($auth_type)
		{
			case 'api':
			if(false === Config::has('whmcs.password') || '' === config('whmcs.password'))
				throw new Exception("Please provide api key for authentication");
			$params['accesskey'] = config('whmcs.password');
			break;
			case 'password':
			if(false === Config::has('whmcs.password') || '' === config('whmcs.password'))
				throw new Exception("Please provide username password for authentication");
			$params['password'] 	= md5(config('whmcs.password'));
			break;
		}

		$url = config('whmcs.url');
		// unset url
		unset($params['url']);

		$client = new Client;
		try
		{
			$response = $client->post($url, ['body'=>$params,'timeout' => 1200,'connect_timeout' => 10]);

			try
			{
				return Whmcs::processResponse($response->json());
			}
			catch(ParseException $e)
			{
				return Whmcs::processResponse($response->xml());
			}
		}
		catch(ClientException $e)
		{
			$response = $e->getResponse()->json();
			throw new Exception($response['message']);
		}

	}

	public static function processResponse($response)
	{
		if(isset($response['result']) && 'error' === $response['result']
			|| isset($response['status']) && 'error' === $response['status'] )
			throw new Exception("WHMCS Response Error : ".$response['message']);
		return json_decode(json_encode($response),'array'===config('whmcs.response', 'object'));
	}

	// using magic method
	public function __call($action, $params)
	{
		return $this->execute($action, $params);
	}

}
