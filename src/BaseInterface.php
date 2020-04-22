<?php

 /**
  * @author @thisismahabadi
  */
interface BaseInterface
{
    /**
     * Preparing data for making request to Slack api.
     *
     * @param array|string|null $params
     */
	public function response($params = null);
}
