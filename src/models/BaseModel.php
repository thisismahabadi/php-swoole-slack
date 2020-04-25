<?php

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
	private $token = 'xoxp-1082401724580-1069499576150-1086112309971-c2bb8a247060272fadd31c0996bff28f';

    /**
     * Make a cURL request to Slack api.
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
