<?php

namespace App\Controller;
use \App;

class IndexController extends AppController
{

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->loadModel("Index");
        $this->loadModel("Categories");
        $this->loadModel("Recipe");
    }

    public function home()
    {
        $categories = $this->Categories->all();
        $recipes = $this->Index->latestRecipes();
        $recipesRating = $this->Index->popularRecipes();
        $this->render('home', compact('recipes', 'categories', 'recipesRating'));
    }

}