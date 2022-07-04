<?php 

namespace Models;

class Regime extends Database
{
    public function getRegimes()
  {
      return $this->getAll("recipe_regime", "recipe_regime_id, recipe_regime_name");
  }
}