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
	public $token = 'token=xoxp-1082401724580-1069499576150-1080124911394-4486284ded5ead02ab8b5250cdb61377';

    /**
     * Make a cURL request to Slack api.
     *
     * @param string $url
     * @param array|string|null $params
     *
     * @return object
     */
	public function fetchData($url, $params = null)
	{
		$cURLConnection = curl_init();

		curl_setopt($cURLConnection, CURLOPT_URL, $url . $this->token . $params);
		curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($cURLConnection);
		curl_close($cURLConnection);

		return json_decode($data);
	}
}
