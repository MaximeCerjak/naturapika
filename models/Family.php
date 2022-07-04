<?php

namespace Models;

class Family extends Database
{
  
  public function getFamilies()
  {
      return $this->getAll("families", "family_id, family_name");
  }
  
    
}    