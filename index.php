<?php
session_start();

spl_autoload_register( function( $class ){
    // Cette fonction permet d'automatiser les require au moment du choix du controller
    require_once lcfirst( str_replace( '\\', '/', $class ) ) . '.php';
});

if( array_key_exists( 'route', $_GET ) )
{ 
    $adminRoutes = ['backoff', 'backoffRecipe', 'backoffPlant', 'backoffUser', 'deleteRecipe', 'deletePlant', 'deleteUSer', 'addPlantAdmin', 'addRecipeAdmin', 'addNewRecipe', 'updateRecipe', 'updatePlant', 'recipeUp', 'plantUp'];
    if( in_array( $_GET['route'], $adminRoutes ) && !isset( $_SESSION['admin'] ) )
    {
        header('location:index.php?route=home');
        exit();
    }
    
    $userRoutes = ['addPlant'];
    if ( in_array( $_GET['route'], $userRoutes ) && !isset( $_SESSION['admin'] ) )
    {
        header('location:index.php?route=home');
        exit();
    }

    switch( $_GET['route'] )
    {
        case 'home':
            $controller = new Controllers\FrontController();
            $controller->displayHomePage();
            break;
        case "" :
            $controller = new Controllers\FrontController();
            $controller->displayHomePage();
            break;      
        case 'aboutMe' :
            $controller = new Controllers\FrontController();
            $controller->displayProfilPage();
            break;
        case 'aboutNaturo' :
            $controller = new Controllers\FrontController();
            $controller->displayNaturoPage();
            break;
        case 'aboutFood' :
            $controller = new Controllers\FrontController();
            $controller->displayFoodPage();
            break;
        case 'coinGourmand' :
            $controller = new Controllers\RecipeController();
            $controller->displayRecipes();
            break;
        case 'recipeInfo' :
            $controller = new Controllers\RecipeController();
            $controller->displayOneRecipe();
            break;
        case 'lifestyle' :
            $controller = new Controllers\FrontController();
            $controller->displayLifestylePage();
            break;
        case 'iridology' :
            $controller = new Controllers\FrontController();
            $controller->displayIridologyPage();
            break;
        case 'library' :
            $controller = new Controllers\PlantController();
            $controller->displayPlant();
            break;
        case "plantGalery" :
            $controller = new Controllers\PlantController();
            $controller->displayGalery();
            break;
        case "plantInfo" :
            $controller = new Controllers\PlantController();
            $controller->displayPlantInfo();
            break; 
        case "addPlant" :
            $controller = new Controllers\PlantController();
            $controller->displayAddPlantForm();
            break;
        case "newPlant" :
            $controller = new Controllers\PlantController();
            $controller->addNewPlant();
            break;
        case 'contact' :
            $controller = new Controllers\ContactController();
            $controller->displayFormContact();
            break;
        case 'sendMessage' :
            $controller = new Controllers\ContactController();
            $controller->sendMessage();
            break;
        case "cg" :
            $controller = new Controllers\FrontController();
            $controller->displayCG();
            break; 
        case "cookiesInfos" :
            $controller = new Controllers\FrontController();
            $controller->displayCookiesInfos();
            break;  
        case "dataProtect" :
            $controller = new Controllers\FrontController();
            $controller->displayDataProtect();
            break;
        case "newAccount" :
            $controller = new Controllers\AccountController();
            $controller->newAccount();
            break;    
        case "connect" :
            $controller = new Controllers\AccountController();
            $controller->logIn();
            break;
        case 'disconnect' :
            $controller = new Controllers\AccountController();
            $controller->disconnect();
            break; 
        
        //ROUTE BACK-OFFICE
        case 'backoff' :
            $controller = new Controllers\AdminController();
            $controller->displayBackOffice();
            break;
        case 'backoffRecipe' :
            $controller = new Controllers\AdminController();
            $controller->displayBackRecipe();
            break;
        case 'backoffPlant' :
            $controller = new Controllers\AdminController();
            $controller->displayBackPlant();
            break;
        case 'backoffUser' :
            $controller = new Controllers\AdminController();
            $controller->displayBackUser();
            break;
        case 'deleteRecipe' :
            $controller = new Controllers\RecipeController();
            $controller->deleteRecipe();
            break;
        case 'deletePlant' :
            $controller = new Controllers\PlantController();
            $controller->deletePlant();
            break;
        case 'deleteUser' :
            $controller = new Controllers\UserController();
            $controller->deleteUser();
            break;  
        case 'addPlantAdmin' :
            $controller = new Controllers\PlantController();
            $controller->displayAddPlantFormAdmin();
            break;
        case 'addRecipeAdmin' :
            $controller = new Controllers\RecipeController();
            $controller->displayAddRecipeFormAdmin();
            break;  
        case 'addNewRecipe' :  
            $controller = new Controllers\RecipeController();
            $controller->addNewRecipe();
            break;
        case 'updateRecipe' :  
            $controller = new Controllers\RecipeController();
            $controller->displayUpdateRecipeForm();
            break;
        case 'recipeUp' :  
            $controller = new Controllers\RecipeController();
            $controller->updateRecipe();
            break;    
        case 'updatePlant' :
            $controller = new Controllers\PlantController();
            $controller->displayUpdatePlantForm();
            break; 
        case 'plantUp' :
            $controller = new Controllers\PlantController();
            $controller->updatePlant();
            break;    
            
    }
}
else
{
    header( 'Location: index.php?route=home' );
    exit();
}