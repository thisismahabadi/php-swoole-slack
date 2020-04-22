<?php

require 'BaseInterface.php';

class BaseModel
{
	public $token = 'token=xoxp-1082401724580-1069499576150-1065376764567-68789de9a798668fe16628959339378a';

	public function fetchData($url, $params = null) {
		$cURLConnection = curl_init();

		curl_setopt($cURLConnection, CURLOPT_URL, $url . $this->token . $params);
		curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($cURLConnection);
		curl_close($cURLConnection);

		return json_decode($data);
	}
}
