<?php

namespace App\Model;
use \Core\Model\Model;

class IngredientModel extends Model
{

    protected $table = "ingredients";

    public function getIngredients($id)
    {
        return json_encode($this->query("SELECT * FROM ingredients WHERE recipe_id = $id"));
    }

}