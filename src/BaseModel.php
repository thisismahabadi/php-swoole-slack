<?php

require 'BaseInterface.php';

/**
 * @author @thisismahabadi
 */
class BaseModel
{
	/**
     * The Slack api token.
     *
     * @var string
     */
	public $token = 'token=xoxp-1082401724580-1069499576150-1086458349908-cda68b21d23e27cbabc466b71498904a';

    /**
     * Make a cURL request to Slack api.
     *
     * @param string $url
     * @param array|string|null $params
     *
     * @return null|object
     */
	public function fetchData($url, $params = null): ?object
	{
		$cURLConnection = curl_init();

		curl_setopt($cURLConnection, CURLOPT_URL, $url . $this->token . $params);
		curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($cURLConnection);
		curl_close($cURLConnection);

		return json_decode($data);
	}
}
