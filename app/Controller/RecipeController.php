<?php

namespace App\Controller;
use \App;

class RecipeController extends AppController
{
    /*
     * RecipeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->loadModel("Index");
        $this->loadModel("Recipe");
        $this->loadModel("Categories");
        $this->loadModel("Difficulties");
        $this->loadModel("Ingredient");
        $this->loadModel("Step");
        $this->loadModel("Comment");
    }

    public function show()
    {
        $recipe = $this->Recipe->getRecipe($_GET['id']);
        $ingredients = $this->Ingredient->getIngredients($_GET['id']);
        $steps = $this->Step->getSteps($_GET['id']);
        $comments = $this->Comment->getComments($_GET['id']);

        $this->render('recipeDetails', compact('recipe', 'ingredients', 'steps', 'comments'));
    }

    public function form_add()
    {
        $categories = $this->Categories->all();
        $difficulties = $this->Difficulties->all();
        $this->render('recipeAdd', compact('categories', 'difficulties'));
    }

    public function add()
    {
        // Get the name of submitted image and put it in lowercase and replace all whitespaces whit underscores
        $imageName = str_replace(' ', '_', strtolower($_FILES['image']['name']));
        // Define target path where the image will be uploaded
        $targetPath = ROOT . "content/img/recipes/";
        // Find the 1st occurrence for point to get the extension name of the file that user selected
        $imageExt = substr($imageName, strpos($imageName, '.'));
        $imageExt = str_replace('.', '', $imageExt);
        // Create array for the image extension to use it later to compare user selected image extension whit array extensions
        $extensions = array("jpeg", "jpg", "png");

        // Check the selected image extension if corresponds to the image's extensions (jpg, jpeg, png) and array($extensions)
        if((($_FILES['image']['type'] == "image/png") || ($_FILES['image']['type'] == "image/jpg") || ($_FILES['image']['type'] == "image/jpeg"))
            && in_array($imageExt, $extensions))
        {
            if(file_exists("img/" . $_FILES['image']['name']))
            {
                echo $_FILES['image']['name'] . "<b>already exists.</b>";
            }
            else
            {
                move_uploaded_file($_FILES['image']['tmp_name'], $targetPath . $imageName);
            }
        }
        else
        {
            $this->setFlash("Format d'image no accepter!", 'warning', 'exclamation-triangle');
        }

        $last_id = $this->Recipe->addRecipe($_POST['title'],
                                    $_POST['username'],
                                    $_POST['user_email'],
                                    $_POST['category_id'],
                                    $_POST['difficulty_id'],
                                    $_POST['note'],
                                    $imageName);
        $this->Recipe->addIngredients($_POST['quan'], $_POST['ingr'], $last_id);
        $this->Recipe->addSteps($_POST['step'], $last_id);
        $recipe = $this->Recipe->getRecipe($last_id);
        $ingredients = $this->Ingredient->getIngredients($last_id);
        $steps = $this->Step->getSteps($last_id);
        $comments = $this->Comment->getComments($last_id);

        $this->render('recipeDetails', compact('recipe', 'ingredients', 'steps', 'comments'));
    }

    public function latest()
    {
        $recipes = $this->Index->latestRecipes();
        $this->render('recipeList', compact('recipes'));
    }

    public function popular()
    {
        $recipes = $this->Index->popularRecipes();
        $popular = true;
        $this->render('recipeList', compact('recipes', 'popular'));
    }

    public function search()
    {
        $name = $_POST['keyword'];
        $recipes = $this->Recipe->search($name);
        $this->render('recipeList', compact('recipes'));
    }

    public function addcom()
    {
        $this->Comment->setComments($_POST['id'], $_POST['user'], $_POST['rating'], $_POST['text']);

        $recipe = $this->Recipe->getRecipe($_POST['id']);
        $ingredients = $this->Ingredient->getIngredients($_POST['id']);
        $steps = $this->Step->getSteps($_POST['id']);
        $comments = $this->Comment->getComments($_POST['id']);

        $this->render('recipeDetails', compact('recipe', 'ingredients', 'steps', 'comments'));
    }
}