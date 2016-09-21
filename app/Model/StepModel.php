<?php

namespace App\Model;
use \Core\Model\Model;

class StepModel extends Model
{

    protected $table = "steps";

    public function getSteps($id)
    {
        return json_encode($this->query("SELECT * FROM steps WHERE recipe_id = $id"));
    }
}