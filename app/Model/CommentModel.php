<?php

namespace App\Model;
use \Core\Model\Model;

class CommentModel extends Model
{

    protected $table = "comments";

    public function getComments($id)
    {
        return json_encode($this->query("SELECT * FROM comments WHERE recipe_id = $id"));
    }

    public function setComments($id, $username, $rating, $text)
    {
        $create_date = date("Y-m-d H:i:s");
        json_encode($this->query2("
            INSERT IGNORE INTO comments(recipe_id, username, rating, description, create_date)
            VALUES(${id}, '${username}', ${rating}, '${text}', '$create_date')
        "));
    }

}