<?php

namespace App\Models;

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
	private $token = 'xoxp-1082401724580-1069499576150-1084560475413-0074349f44d2bfa968dea8f606f7c152';

    /**
     * Make a cURL request to Slack api.
     *
	 * @throws \Exception
	 *
     * @param string $url
     * @param array|string|null $params
     *
     * @return null|object
     */
	protected function fetchData(string $url, $params = null): ?object
	{
		try {
			$cURLConnection = curl_init();

			curl_setopt($cURLConnection, CURLOPT_URL, $url . 'token=' . $this->token . $params);
			curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

			$data = curl_exec($cURLConnection);
			curl_close($cURLConnection);

			return json_decode($data);
		} catch (Exception $e) {
			throw new Exception($e);
		}
	}
}
