<?php

namespace Controllers;

class UserController
{
    
     public function deleteUser()
    {
        $userModel = new \Models\User();
        
        if( isset( $_GET['userID'] ))
        {
            $userModel->deleteUser( $_GET['userID'] );
        }
        
        header ( 'Location:index.php?route=backoffUser' );
        exit();
    }
        
}    