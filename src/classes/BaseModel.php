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
	public $token = 'xoxp-1082401724580-1069499576150-1083642132835-d0a01e27284f78106c9fd18871edcf2e';

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
		try {
			$cURLConnection = curl_init();

			curl_setopt($cURLConnection, CURLOPT_URL, $url . 'token=' . $this->token . $params);
			curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

			$data = curl_exec($cURLConnection);
			curl_close($cURLConnection);

			return json_decode($data);
		} catch (Exception $e) {
			echo $e->getMessage(); die;
		}
	}
}
