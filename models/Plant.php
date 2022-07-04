<?php

namespace Models;

class Plant extends Database
{
    public function getAllPlants()
    {
        return $this->getAll( "plants", "plant_name, plant_id, isActive" );    
    }
    
    
    public function getAllDataPlant()
    {
        $joinsTables =
        [
            'plant_picture.plant_picture_id' => 'plants.plant_picture_id',
            'families.family_id' => 'plants.family_id'
        ];
        
        $colID = [ '.plant_picture_id', '.family_id' ];
        
        return $this->getElementsByJoints( 'plant_id, plant_name, plant_scientific_name, family_name, plant_origin_description, plant_globals_properties, url_small, isActive', 'plants', $joinsTables, $colID);
    }
    
    
     public function getPictureOfPlant()
    {
        $joinsTables =
        [
            'plant_picture.plant_picture_id' => 'plants.plant_picture_id',
            'families.family_id' => 'plants.family_id'
        ];
        
        $colID = [ '.plant_picture_id', '.family_id' ];
        
        return $this->getElementsByJoints( 'plant_id, url_small, plant_name, family_name', 'plants', $joinsTables, $colID);
    }
    
    public function getPictureByUrl( $url )
    {
        return $this->getOne( 'plant_picture_id', 'plant_picture', 'url_small', $url );
    }
    
      public function getPlantInfo($getID)
    {
        $joinsTables =
        [
            'plant_picture.plant_picture_id' => 'plants.plant_picture_id',
            'families.family_id' => 'plants.family_id'
        ];
        
        $colID = [ '.plant_picture_id', '.family_id' ];
        
        return $this->getElementsByJointsWithCondition( 'plant_id, plant_name, plant_scientific_name, plant_origin_description, family_name, families.family_id, url_small, plant_composition, plant_globals_properties, plant_internal_use, plant_external_use, plant_anecdote, plant_toxicity, plant_other_uses, plant_traditional_use, plant_properties_description, plant_specimens, isActive', 'plants', $joinsTables, $colID, 'plant_id', $getID);
    }
    
    public function insertPicture( array $data )
    {
        return $this->addOne( "plant_picture", "url_small", "?", $data );
    }
    
    public function insertPlant( array $data )
    {
        return $this->addOne( "plants", "plant_name, plant_scientific_name, family_id, plant_picture_id, plant_origin_description, plant_composition, plant_traditional_use, plant_properties_description, plant_globals_properties, plant_internal_use, plant_external_use, plant_other_uses, plant_toxicity, plant_anecdote, plant_specimens, user_id", "?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?", $data );
    }
    
    public function insertPlantAdmin( array $data )
    {
        return $this->addOne( "plants", "plant_name, plant_scientific_name, family_id, plant_picture_id, plant_origin_description, plant_composition, plant_traditional_use, plant_properties_description, plant_globals_properties, plant_internal_use, plant_external_use, plant_other_uses, plant_toxicity, plant_anecdote, plant_specimens, user_id, isActive", "?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?", $data );
    }
    
     public function updatePlant( array $newData, $getID)
    {
        $this->updateOne( 'plants', $newData, 'plant_id', $getID);
    }
    
    
    public function deletePlant( $id )
    {
        return $this->deleteOne( "plants", "plant_id", $id );
    }
}