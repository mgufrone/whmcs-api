<?php namespace Queiroz\WhmcsApi;

class WhmcsApi 
{

	public function init($action, $actionParams)
	{

		$params = array();
		$params['username'] 	= \Config::get('whmcs-api::username');
		$params['password'] 	= md5(\Config::get('whmcs-api::password'));
		$params['url'] 			= \Config::get('whmcs-api::url');
		$params['action']		= $action;

		// merge $actionParams with $params
		$params = array_merge($params, $actionParams);

		// call curl init connection
		return $this->curl($params);

	}

	public function curl($params)
	{
		// set url
		$url = $params['url'];
		// unset url
		unset($params['url']);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 100);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		$data = curl_exec($ch);

		if (curl_error($ch)) {
			throw new Exception("Connection Error: " . curl_errno($ch) . ' - ' . curl_error($ch));
		}

		curl_close($ch);

		// Identify XML result
		$xml = preg_match('/(\<\?xml)/', $data);
		
		if($xml) {
			return $this->formatXml($data);
		} else {
			return $this->formatObject($data);
		}

	}

	public function formatXml($input)
	{
		return new \SimpleXMLElement($input);
	}

	public function formatObject($input)
	{

		$results = explode(';' ,$input);

		$object = new \stdClass(); // standard object

		foreach($results as $result) {

			if(!empty($result)) {
				$resultValue = explode('=', $result);
				$object->$resultValue[0] = $resultValue[1];
			}

		}

		return $object;
	}

	public function execute($action, $params)
	{
		
		// Initiate
		return $this->init($action, $params);

	}

}