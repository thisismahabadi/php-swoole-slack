<?php

namespace App\Core;

/**
 * @author @thisismahabadi
 */
class Controller
{
    /**
     * Instantiate a view.
     *
     * @param string $view
     * @param array $params
     *
	 * @return void
     */
    public function setView(string $view, array $params = []): void
    {
        require_once __DIR__ . '/../Views/' . $view . '.php';
    }
}
