<?php

class Controller
{
    public function model($model)
    {
        require_once __DIR__ . '/../models/slack/' . $model . '.php';
        return new $model;
    }

    public function view($view, $params = [])
    {
        require_once __DIR__ . '/../views/' . $view . '.php';
    }
}
