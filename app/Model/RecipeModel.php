<?php

namespace App\Model;
use \Core\Model\Model;

class RecipeModel extends Model
{

    public function getRecipe($id)
    {
        return json_encode($this->query("
            SELECT r.id_recipe, r.title, r.username, r.user_email, r.create_date, r.category_id, r.difficulty_id, r.note, r.image_url,
              ROUND(AVG(c.rating)) AS rating, COUNT(c.rating) AS nb_raing
            FROM recipes r
              LEFT JOIN comments c
              ON r.id_recipe = c.recipe_id
            WHERE id_recipe = $id
        ", NULL, true));
    }

    public function addRecipe($title, $username, $user_email, $category_id, $dificulty_id, $note, $image_url)
    {
        $create_date = date("Y-m-d H:i:s");
        $image_url = strtolower($image_url);
        $image_url = preg_replace('/\s+/', '_', strtolower($image_url));
        json_encode($this->query2("
              INSERT IGNORE INTO recipes(title, username, user_email, create_date, category_id, difficulty_id, note, image_url)
              VALUES('$title', '$username', '$user_email', '$create_date', $category_id, $dificulty_id, '$note', './content/img/recipes/$image_url')
        "));
        return $this->getLastId();
    }

    public function addIngredients($quantities, $ingredients, $recipe_id)
    {
        $i = 0;
        foreach ($quantities as $quantity)
        {
            json_encode($this->query2("
                INSERT IGNORE INTO ingredients(name, quantity, recipe_id)
                VALUES('$ingredients[$i]', '$quantity', $recipe_id)
            "));
            $i++;
        }
    }

    public function addSteps($steps, $recipe_id)
    {
        $i = 1;
        foreach ($steps as $step)
        {
            json_encode($this->query2("
                INSERT IGNORE INTO steps(step_nb, description, recipe_id)
                VALUES('$i', '$step', $recipe_id)
            "));
            $i++;
        }
    }

    public function search($name, $key = NULL)
    {
        $sql = "SELECT r.id_recipe, r.title, r.image_url , r.note, r.create_date, ROUND(AVG(c.rating)) AS rating, COUNT(c.rating) AS nb_raing
                FROM recipes AS r
                LEFT JOIN ingredients AS i ON r.id_recipe=i.recipe_id
                LEFT JOIN comments c ON r.id_recipe = c.recipe_id
                WHERE r.title LIKE '%" . $name .  "%'
                OR r.username LIKE '%" . $name .  "%'
                OR i.name LIKE '%" . $name .  "%'
                GROUP BY r.id_recipe
                ";
        return json_encode($this->query($sql));
    }

}