<?php

namespace App\Controller;
use Core\Controller\Controller;
use \App;

class AppController extends Controller
{

    protected $template = 'default';
    protected $viewPath;

    /**
     * AppController constructor.
     */
    public function __construct()
    {
        $this->viewPath = ROOT . '/app/Views/';
    }

    /**
     * Permet de charge le model
     * @param $model_name
     */
    protected function loadModel($model_name)
    {
        $this->$model_name = App::getInstance()->getTable($model_name);
    }

}