<?php

namespace Models;

class Recipe extends Database
{
    
    public function getLastRecipes()
    {
        $joinsTables =
        [
            'recipe_picture.recipe_picture_id' => 'recipes.recipe_picture_id',
            'recipe_type.recipe_type_id' => 'recipes.recipe_type_id',
            'recipe_regime.recipe_regime_id' => 'recipes.recipe_regime_id'
        ];
        
        $colID = [ '.recipe_picture_id', '.recipe_type_id', '.recipe_regime_id' ];
        
        return $this->getElementsByJointsLimited( 'recipe_id, recipe_name, url_recipe_picture, recipe_description, recipe_type_name, url_regime_icon, recipe_regime_name, isActive', 'recipes', $joinsTables, $colID, 'recipe_date'); 
        
    }
    
    public function getRecipesTypeRegime()
    {
        $joinsTables =
        [
            'recipe_picture.recipe_picture_id' => 'recipes.recipe_picture_id',
            'recipe_type.recipe_type_id' => 'recipes.recipe_type_id',
            'recipe_regime.recipe_regime_id' => 'recipes.recipe_regime_id'
        ];
        
        $colID = [ '.recipe_picture_id', '.recipe_type_id', '.recipe_regime_id' ];
        
        return $this->getElementsByJoints( 'recipe_id, recipe_name, recipe_type_name, recipe_regime_name, isActive', 'recipes', $joinsTables, $colID); 
        
    }
    
    public function getOneRecipe($getID)
    {
         $joinsTables =
        [
            'recipe_picture.recipe_picture_id' => 'recipes.recipe_picture_id',
            'recipe_type.recipe_type_id' => 'recipes.recipe_type_id',
            'recipe_regime.recipe_regime_id' => 'recipes.recipe_regime_id'
        ];
        
        $colID = [ '.recipe_picture_id', '.recipe_type_id', '.recipe_regime_id' ];
        
        return $this->getElementsByJointsWithCondition( "recipe_name, recipe_description, recipe_type_name, recipe_regime_name, url_regime_icon, url_recipe_picture, recipe_preparation_time, recipe_cook_time, recipe_rest_time, recipe_difficulty_level, recipe_ingredients, recipe_preparation, recipe_price, recipe_allergens", "recipes", $joinsTables, $colID, "recipe_id", $getID );
    }
    
    public function getAllRecipes()
    {
        return $this->getAll( "recipes", "recipe_id, recipe_name" );
    }
    
    public function insertPicture( array $data )
    {
        return $this->addOne( "recipe_picture", "url_recipe_picture", "?", $data );
    }
    
    public function insertRecipe( array $data )
    {
        return $this->addOne( "recipes", "recipe_name, recipe_type_id, recipe_regime_id, recipe_picture_id, recipe_description, recipe_preparation, recipe_ingredients, recipe_difficulty_level, recipe_price, recipe_preparation_time, recipe_cook_time, recipe_rest_time, isActive", "?,?,?,?,?,?,?,?,?,?,?,?,?", $data );
    }
    
    public function getPictureByUrl( $url )
    {
        return $this->getOne( 'recipe_picture_id', 'recipe_picture', 'url_recipe_picture', $url );
    }
    
    public function updateRecipe()
    {
        
    }
    
    public function deleteRecipe( $id )
    {
        return $this->deleteOne( "recipes", "recipe_id", $id );
    }
    
     
}