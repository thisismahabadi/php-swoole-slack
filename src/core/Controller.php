<?php

/**
 * @author @thisismahabadi
 */
class Controller
{
    /**
     * Instantiate a model.
     *
     * @param string $model
     *
	 * @return object
     */
    public function model(string $model): object
    {
        require_once __DIR__ . '/../models/slack/' . $model . '.php';
        return new $model;
    }

    /**
     * Instantiate a view.
     *
     * @param string $view
     * @param array $params
     *
	 * @return void
     */
    public function view(string $view, array $params = []): void
    {
        require_once __DIR__ . '/../views/' . $view . '.php';
    }
}
