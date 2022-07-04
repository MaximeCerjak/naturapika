<?php

namespace Controllers;

class RecipeController
{
    public function displayRecipes()
    {
        $recipeModel = new \Models\Recipe();
        $recipes = $recipeModel->getLastRecipes();
        $recipesList = $recipeModel->getRecipesTypeRegime();
        
        $headerView = 'food_header.phtml';
        $view = 'recipes.phtml';
        include_once 'views/layout.phtml';
    }
    
    public function displayOneRecipe()
    {
        $recipeModel = new \Models\Recipe();
        $recipe = $recipeModel->getOneRecipe( $_GET['recipeID'] );
        
        $headerView = 'food_header.phtml';
        $view = 'recipeInfo.phtml';
        include_once 'views/layout.phtml';
    }
    
    public function displayAddRecipeFormAdmin()
    {
        $regimeModel = new \Models\Regime();
        $typeModel = new \Models\Type();
        
        $regimes = $regimeModel->getRegimes();
        $types = $typeModel->getTypes();
        
        $view = 'addRecipe.phtml';
        include_once 'views/backoff.phtml';
    }
    
    public function addNewRecipe()
    {
        $recipeModel = new \Models\Recipe();
        
        
        if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0)
        {
            $image_size = getimagesize($_FILES['picture']['tmp_name']);
            $width = $image_size[0];
            $height = $image_size[1];
            
            if ( $_FILES['picture']['size'] <= 1000000 && $height < $width)
            {
                
                $fileInfo = pathinfo($_FILES['picture']['name']);
                $extension = $fileInfo['extension'];
                $allowedExtensions = ['jpg', 'png'];
                if ( in_array( $extension, $allowedExtensions )) 
                {
                    $tmp_name = $_FILES["picture"]["tmp_name"];
                    var_dump(getimagesize($tmp_name));
                    $name = basename($_FILES["picture"]["name"]);
                    $filter_name = str_replace(" ", "-", $name);
                    $chemin = 'public/images/recipes/';
                    move_uploaded_file($tmp_name, $chemin.$filter_name);
                    
                    $recipeModel->insertPicture([$chemin.$filter_name]);
                }
                else
                {
                    header ( 'Location: index.php?route=addRecipe&file-extension=false' );
                    exit();
                }
            } 
            else
            {
                header ( 'Location: index.php?route=addRecipe&error=file-size' );
                exit(); 
            }
        }
        
        $lastRecipePicture = $recipeModel->getPictureByUrl( $chemin.$filter_name );
        
        
        if( isset( $_POST['recipe-name'] ) && !empty( $_POST['recipe-name'] ) 
        && isset( $_POST['type'] ) && !empty( $_POST['type'] )
        && isset( $_POST['regime'] ) && !empty( $_POST['regime'] ) 
        && isset( $_POST['description'] ) && !empty( $_POST['description'] )
        && isset( $_POST['preparation'] ) && !empty( $_POST['preparation'] )
        && isset( $_POST['ingredients'] ) && !empty( $_POST['ingredients'] )
        && isset( $_POST['difficulty'] ) && !empty( $_POST['difficulty'] )
        && isset( $_POST['price'] ) && !empty( $_POST['price'] )
        && isset( $_POST['preparation-time'] ) && !empty( $_POST['preparation-time'] )
        &&isset( $_POST['cook-time'] ) && isset( $_POST['rest-time'] ) 
        && isset( $_POST['isActive'] ) && !empty( $_POST['isActive'] )) 
        {
        

            $recipe_name = htmlspecialchars( $_POST['recipe-name'] );
            $type = htmlspecialchars( $_POST['type'] );
            $regime = htmlspecialchars( $_POST['regime'] );
            $description = htmlspecialchars( $_POST['description'] );
            $preparation = htmlspecialchars( $_POST['preparation'] );
            $ingredients = htmlspecialchars( $_POST['ingredients'] );
            $difficulty = htmlspecialchars( $_POST['difficulty'] );
            $price = htmlspecialchars( $_POST['price'] );
            $prepa_time = htmlspecialchars( $_POST['preparation-time'] );
            $cook_time = htmlspecialchars( $_POST['cook-time'] );
            $rest_time = htmlspecialchars( $_POST['rest-time'] );
            $isActive = htmlspecialchars( $_POST['isActive'] );
            $picture_id = $lastRecipePicture['recipe_picture_id'];
            
            $recipeModel->insertRecipe(
                [
                   $recipe_name,
                   $type,
                   $regime,
                   $picture_id,
                   $description,
                   $preparation,
                   $ingredients,
                   $difficulty,
                   $price,
                   $prepa_time,
                   $cook_time,
                   $rest_time,
                   $isActive
                ]);
                
        
        }
        else
        {
            header ( 'Location: index.php?route=backoffRecipe&add=false' );
            exit();
        }
        
        header ( 'Location: index.php?route=backoffRecipe&add=true' );
        exit();
        
    }
    
     public function deleteRecipe()
    {
        $recipeModel = new \Models\Recipe();
        
        if( isset( $_GET['recipeID'] ))
        {
            $recipeModel->deleteRecipe( $_GET['recipeID'] );
        }
        else
        {
            header ( 'Location:index.php?route=backoffRecipe&deleted=false' );
            exit();
        }
        
        header ( 'Location:index.php?route=backoffRecipe&deleted=true' );
        exit();
        
    }
}