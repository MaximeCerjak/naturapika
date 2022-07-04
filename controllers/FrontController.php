<?php

namespace Controllers;

class FrontController
{
    public function displayHomePage()
    {
        $headerView = 'header_home.phtml';
        $view = 'home.phtml';
        include_once 'views/layout.phtml';
    }
    
    public function displayProfilPage()
    {
        $headerView = 'general_header.phtml';
        $view = 'aboutMe.phtml';
        include_once 'views/layout.phtml';
    }
    
    public function displayNaturoPage()
    {
        $headerView = 'general_header.phtml';
        $view = 'aboutNaturo.phtml';
        include_once 'views/layout.phtml';
    }
    
    public function displayFoodPage()
    {
        $headerView = 'food_header.phtml';
        $view = 'food.phtml';
        include_once 'views/layout.phtml';
    }
    
    public function displayLifestylePage()
    {
        $headerView = 'general_header.phtml';
        $view = 'lifestyle.phtml';
        include_once 'views/layout.phtml';
    }
    
    public function displayIridologyPage()
    {
        $headerView = 'general_header.phtml';
        $view = 'iridology.phtml';
        include_once 'views/layout.phtml';
    }
    
    public function displayCG()
    {
        $headerView = 'general_header.phtml';
        $view = 'cg.phtml';
        include_once 'views/layout.phtml';
    }
    
    public function displayCookiesInfos()
    {
        $headerView = 'general_header.phtml';
        $view = 'cookiesInfos.phtml';
        include_once 'views/layout.phtml';
    }
    
    public function displayDataProtect()
    {
        $headerView = 'general_header.phtml';
        $view = 'dataProtect.phtml';
        include_once 'views/layout.phtml';
    }
    
}