<?php

namespace Models;

class Account extends Database
{
    public function addNewUser( array $data )
    {
        return $this->addOne( 'users', 'user_lastname, user_firstname, user_email, user_password',
        '?,?,?,?', $data);
    }
    
    public function getUser( string $uniq )
    {
       return $this->getOne( 'user_id, user_lastname, user_firstname, user_email, user_password, user_role', 'users', 'user_email', $uniq );
    }
    
    public function getEmail()
    {
        return $this->get( "users", "user_email" );
    }
}