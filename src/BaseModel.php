<?php

require 'BaseInterface.php';

class BaseModel
{
	public $token = 'token=xoxp-1082401724580-1069499576150-1090406197793-9c04c1bd08244cf003b2c3ac1a0254cc';

	public function fetchData($url, $params = null) {
		$cURLConnection = curl_init();

		curl_setopt($cURLConnection, CURLOPT_URL, $url . $this->token . $params);
		curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($cURLConnection);
		curl_close($cURLConnection);

		return json_decode($data);
	}
}
