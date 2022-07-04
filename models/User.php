<?php

namespace Models;

class User extends Database
{
    public function getAllUsers()
    {
        return $this->getAll( "users", "user_id, user_lastname, user_firstname");
    }
    
    public function deleteUser( $id )
    {
        return $this->deleteOne( "users", "user_id", $id );
    }
}