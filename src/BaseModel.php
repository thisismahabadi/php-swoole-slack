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
	public $token = 'xoxp-1082401724580-1069499576150-1078926410949-d1a1d546afdaf780f647941a23cb90e7';

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

		curl_setopt($cURLConnection, CURLOPT_URL, $url . 'token=' . $this->token . $params);
		curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($cURLConnection);
		curl_close($cURLConnection);

		return json_decode($data);
	}
}
