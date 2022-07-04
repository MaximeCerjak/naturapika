<?php 

namespace Models;

class Type extends Database
{
    public function getTypes()
  {
      return $this->getAll("recipe_type", "recipe_type_id, recipe_type_name");
  }
}