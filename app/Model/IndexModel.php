<?php

namespace App\Model;
use \Core\Model\Model;

class IndexModel extends Model
{

    protected $table = "recipes";

    public function getRecipes($category_id)
    {
        return json_encode($this->query("SELECT * FROM recipes WHERE category_id = $category_id"));
    }

    public function latestRecipes()
    {
        return json_encode($this->query("
            SELECT  r.id_recipe, r.title, r.image_url , r.note, r.create_date, ROUND(AVG(c.rating)) AS rating, COUNT(c.rating) AS nb_raing
            FROM recipes r
            LEFT JOIN comments c ON r.id_recipe = c.recipe_id
            GROUP BY r.id_recipe
            ORDER BY create_date DESC
        "));
    }

    public function popularRecipes()
    {
        return json_encode($this->query("
            SELECT r.id_recipe, r.title, r.image_url, r.note, r.create_date, ROUND(AVG(c.rating)) AS rating, COUNT(c.rating) AS nb_raing
            FROM recipes r
            LEFT JOIN comments c ON r.id_recipe = c.recipe_id
            WHERE rating >= 3
            GROUP BY r.title
            ORDER BY rating DESC
        "));
    }

}