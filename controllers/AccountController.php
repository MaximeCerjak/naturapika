<?php

namespace Controllers;

class AccountController
{
    private $connect = true;
    
    public function newAccount()
    {
        $accountModel = new \Models\Account();
        
        
            if( isset( $_POST['firstname'] ) && !empty( $_POST['firstname'] ) && isset( $_POST['lastname'] ) && !empty( $_POST['lastname']) && isset( $_POST['email'] ) && !empty( $_POST['email'] ) && isset( $_POST['password'] ) && !empty( $_POST['password'] ) )
            {
                $ashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                
                $accountModel->addNewUser(
                    [
                       htmlspecialchars( $_POST['lastname'] ),
                       htmlspecialchars( $_POST['firstname'] ),
                       $email,
                       $ashedPassword
                    ]);
                    
            }
            
            $user = $accountModel->getUser( $_POST['email'] );
            $_SESSION['user'] = $user;
            header('location:index.php?route=home');
            exit(); 
            
    }
    
    public function logIn()
    {
        $accountModel = new \Models\Account();
        var_dump($_POST['email']);
        if( isset( $_POST['email'] ) && isset( $_POST['password'] ) )
        {
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $user = $accountModel->getUser( $email );
            if( $user )
            {
                var_dump( $user );
                if( password_verify( $_POST['password'], $user['user_password'] ) )
                {
                    if( $user['user_role'] == "ROLE_USER" )
                    {
                        
                        $_SESSION['user'] = $user;
                        header('location:index.php?route=home');
                        exit;
                        
                    } 
                    elseif ( $user['user_role'] == "ROLE_ADMIN" )
                    {
                        
                        $_SESSION['admin'] = $user;
                        header('location:index.php?route=home');
                        exit;
                        
                    }
                }
                else 
                {
                    var_dump( $user );
                    header('location:index.php?route=home');
                    exit;
                }
            }
        }
    }
        
    
    public function disconnect()
    {
        session_destroy();
        
        header('location:index.php?route=home');
        exit;
    }
}