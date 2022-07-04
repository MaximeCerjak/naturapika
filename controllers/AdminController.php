<?php

namespace Controllers;

class AdminController
{
    public function displayBackOffice()
    {
        $view = "backoffHome.phtml";
        
        include_once "views/backoff.phtml";
    }
    
    public function displayBackRecipe()
    {
        $recipeModel = new \Models\Recipe();
        $recipes = $recipeModel->getAllRecipes();
        
        $view = "manageAdmin.phtml";
        include_once "views/backoff.phtml";
        
    }
    
    public function displayBackUser()
    {
        $userModel = new \Models\User();
        $users = $userModel->getAllUsers();
        
        $view = "manageAdmin.phtml";
        include_once "views/backoff.phtml";
        
    }
    
    public function displayBackPlant()
    {
        $plantModel = new \Models\Plant();
        $plants = $plantModel->getAllPlants();
        
        $view = "manageAdmin.phtml";
        include_once "views/backoff.phtml";
        
    }
}