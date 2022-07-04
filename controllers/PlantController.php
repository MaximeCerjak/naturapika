<?php

namespace Controllers;

class PlantController
{
    public function displayPlant()
    {
        $plantModel = new \Models\Plant();
        $plants = $plantModel->getAllDataPlant();
        
        $headerView = 'general_header.phtml';
        $view = 'library.phtml';
        include_once 'views/layout.phtml';
    }
    
    
    public function displayGalery()
    {
        $plantModel = new \Models\Plant();
        $plants = $plantModel->getPictureOfPlant();
        
        $headerView = 'general_header.phtml';
        $view = 'plantGalery.phtml';
        include_once 'views/layout.phtml';
    }
    
    
    public function displayPlantInfo()
    {
        $plantModel = new \Models\Plant();
        
        if( isset( $_GET['plantID'] ) )
        {
             $plant = $plantModel->getPlantInfo( $_GET['plantID'] );
        }
        
        $headerView = 'general_header.phtml';
        $view = 'plantInfo.phtml';
        include_once 'views/layout.phtml';
    }
    
    
    public function displayAddPlantForm()
    {
        $familyModel = new \Models\Family();
        
        $families = $familyModel->getFamilies();
        
        $headerView = 'general_header.phtml';
        $view = 'addPlant.phtml';
        include_once 'views/layout.phtml';
    }
    
    public function displayUpdatePlantForm()
    {
        $familyModel = new \Models\Family();
        $plantModel = new \Models\Plant();
        
        $families = $familyModel->getFamilies();
        
        if( isset( $_GET['plantID'] ) )
        {
            $plant = $plantModel->getPlantInfo( $_GET['plantID'] );
        }
        
        
        $view = 'addPlant.phtml';
        include_once 'views/backoff.phtml';
    }
    
    public function displayAddPlantFormAdmin()
    {
        $familyModel = new \Models\Family();
        
        $families = $familyModel->getFamilies();
        
        $view = 'addPlant.phtml';
        include_once 'views/backoff.phtml';
    }
    
    public function addNewPlant()
    {
        $plantModel = new \Models\Plant();
        
        
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
                    //filtrer les espaces dans les noms de fichier str_replace
                    $tmp_name = $_FILES["picture"]["tmp_name"];
                    var_dump(getimagesize($tmp_name));
                    $name = basename($_FILES["picture"]["name"]);
                    $filter_name = str_replace(" ", "-", $name);
                    $chemin = 'public/images/plantes/';
                    move_uploaded_file($tmp_name, $chemin.$filter_name);
                    
                    $plantModel->insertPicture([$chemin.$filter_name]);
                }
                else
                {
                    header ( 'Location: index.php?route=addPlant&file-extension=false' );
                    exit();
                }
            } 
            else
            {
                header ( 'Location: index.php?route=addPlant&file-size=false' );
                exit();  
            }
        }
        else
        {
            header ( 'Location: index.php?route=addPlant&add=true' );
            exit();    
        }
        
        $lastPlantPicture = $plantModel->getPictureByUrl( $chemin.$filter_name );
        
        
        if( isset( $_POST['plant-name'] ) && !empty( $_POST['plant-name'] ) 
        && isset( $_POST['plant-sc-name'] ) && !empty( $_POST['plant-sc-name'] )
        && isset( $_POST['family'] ) && !empty( $_POST['family'] ) 
        && isset( $_POST['description'] ) && !empty( $_POST['description'] )
        && isset( $_POST['composition'] ) && !empty( $_POST['composition'] )
        && isset( $_POST['trad-use'] ) && !empty( $_POST['trad-use'] )
        && isset( $_POST['props'] ) && !empty( $_POST['props'] )
        && isset( $_POST['glob-prop'] ) && !empty( $_POST['glob-prop'] )
        && isset( $_POST['int-use'] ) && isset( $_POST['ext-use'] ) 
        && isset( $_POST['other-use'] ) && isset( $_POST['toxic'] )
        && isset( $_POST['specimen'] ) && isset( $_POST['anecdote'] ) ) 
        {
        
            $plant_name = htmlspecialchars( $_POST['plant-name'] );
            $plant_sc_name = htmlspecialchars( $_POST['plant-sc-name'] );
            $description = $_POST['description'];
            $compo = $_POST['composition'];
            $trad_use = $_POST['trad-use'];
            $props = $_POST['props'];
            $glob_prop = $_POST['glob-prop'];
            $int_use = $_POST['int-use'];
            $ext_use = $_POST['ext-use'];
            $other_use = $_POST['other-use'];
            $toxic = $_POST['toxic'];
            $anecdote = $_POST['anecdote'];
            $specimen = $_POST['specimen'];
            $family = $_POST['family'];
            $picture_id = $lastPlantPicture['plant_picture_id'];
            $user_id = $_SESSION['user']['user_id'];
            
            $inputControl = [
                                $description,
                                $compo,
                                $trad_use,
                                $props,
                                $glob_prop,
                                $int_use,
                                $ext_use,
                                $other_use,
                                $toxic,
                                $anecdote,
                                $specimen
                            ];
                            
            foreach( $inputControl as $input )
            {
                if( $input === '' )
                {
                    return $input = null;
                }
            }
            
            
            $plantModel->insertPlant(
                [
                   $plant_name,
                   $plant_sc_name,
                   $family,
                   $picture_id,
                   $description,
                   $compo,
                   $trad_use,
                   $props,
                   $glob_prop,
                   $int_use,
                   $ext_use,
                   $other_use,
                   $toxic,
                   $anecdote,
                   $specimen,
                   $user_id,
                ]);
        }
        
        header ( 'Location: index.php?route=library' );
        exit();
    }
    
     public function addNewPlantAdmin()
    {
        $plantModel = new \Models\Plant();
        
        
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
                    $chemin = 'public/images/plantes/';
                    move_uploaded_file($tmp_name, $chemin.$filter_name);
                    
                    $plantModel->insertPicture([$chemin.$filter_name]);
                }
                else
                {
                    header ( 'Location: index.php?route=addPlantAdmin&error=file-extension' );
                    exit();
                }
            } 
            else
            {
                header ( 'Location: index.php?route=addPlantAdmin&error=file-size' );
                exit();
            }
        }
        
        $lastPlantPicture = $plantModel->getPictureByUrl( $chemin.$filter_name );
        
        
        if( isset( $_POST['plant-name'] ) && !empty( $_POST['plant-name'] ) 
        && isset( $_POST['plant-sc-name'] ) && !empty( $_POST['plant-sc-name'] )
        && isset( $_POST['family'] ) && !empty( $_POST['family'] ) 
        && isset( $_POST['description'] ) && !empty( $_POST['description'] )
        && isset( $_POST['composition'] ) && !empty( $_POST['composition'] )
        && isset( $_POST['trad-use'] ) && !empty( $_POST['trad-use'] )
        && isset( $_POST['props'] ) && !empty( $_POST['props'] )
        && isset( $_POST['glob-prop'] ) && !empty( $_POST['glob-prop'] )
        && isset( $_POST['int-use'] ) && isset( $_POST['ext-use'] ) 
        && isset( $_POST['other-use'] ) && isset( $_POST['toxic'] )
        && isset( $_POST['specimen'] ) && isset( $_POST['anecdote']) 
        && isset( $_POST['isActive'] ) ) 
        {
        
            $plant_name = htmlspecialchars( $_POST['plant-name'] );
            $plant_sc_name = htmlspecialchars( $_POST['plant-sc-name'] );
            $description =  $_POST['description'];
            $compo =  $_POST['composition'];
            $trad_use =  $_POST['trad-use'];
            $props =  $_POST['props'];
            $glob_prop =  $_POST['glob-prop'];
            $int_use =  $_POST['int-use'];
            $ext_use =  $_POST['ext-use'];
            $other_use =  $_POST['other-use'];
            $toxic =  $_POST['toxic'];
            $anecdote =  $_POST['anecdote'];
            $specimen =  $_POST['specimen'];
            $family = $_POST['family'];
            $picture_id = $lastPlantPicture['plant_picture_id'];
            $user_id = $_SESSION['user']['user_id'];
            $isActive = $_POST['isActive'];
            
            
            
            $inputControl = [
                                $description,
                                $compo,
                                $trad_use,
                                $props,
                                $glob_prop,
                                $int_use,
                                $ext_use,
                                $other_use,
                                $toxic,
                                $anecdote,
                                $specimen
                            ];
                            
            foreach( $inputControl as $input )
            {
                if( $input === '' )
                {
                    return $input = null;
                }
            }
            
            
            $plantModel->insertPlantAdmin(
                [
                   $plant_name,
                   $plant_sc_name,
                   $family,
                   $picture_id,
                   $description,
                   $compo,
                   $trad_use,
                   $props,
                   $glob_prop,
                   $int_use,
                   $ext_use,
                   $other_use,
                   $toxic,
                   $anecdote,
                   $specimen,
                   $user_id,
                   $isActive
                ]);
        }
        else
        {
            header ( 'Location: index.php?route=backoffPlant&add=false' );
            exit();    
        }
        
        header ( 'Location: index.php?route=backoffPlant&add=true' );
        exit();
    }
    
    
    public function updatePlant()
    {
       $plantModel = new \Models\Plant();
       
       if( isset( $_POST['plant-name'] ) && !empty( $_POST['plant-name'] ) 
        && isset( $_POST['plant-sc-name'] ) && !empty( $_POST['plant-sc-name'] )
        && isset( $_POST['family'] ) && !empty( $_POST['family'] ) 
        && isset( $_POST['description'] ) && !empty( $_POST['description'] )
        && isset( $_POST['composition'] ) && !empty( $_POST['composition'] )
        && isset( $_POST['trad-use'] ) && !empty( $_POST['trad-use'] )
        && isset( $_POST['props'] ) && !empty( $_POST['props'] )
        && isset( $_POST['glob-prop'] ) && !empty( $_POST['glob-prop'] )
        && isset( $_POST['int-use'] ) && isset( $_POST['ext-use'] ) 
        && isset( $_POST['other-use'] ) && isset( $_POST['toxic'] )
        && isset( $_POST['specimen'] ) && isset( $_POST['anecdote'] ) 
        && isset( $_POST['isActive'] ) && isset( $_POST['plantID'] ) ) 
        {
        
            $plant_name = htmlspecialchars( $_POST['plant-name'] );
            $plant_sc_name = htmlspecialchars( $_POST['plant-sc-name'] );
            $description = $_POST['description'];
            $compo = $_POST['composition'];
            $trad_use = $_POST['trad-use'];
            $props = $_POST['props'];
            $glob_prop = $_POST['glob-prop'];
            $int_use = $_POST['int-use'];
            $ext_use = $_POST['ext-use'];
            $other_use = $_POST['other-use'];
            $toxic = $_POST['toxic'];
            $anecdote = $_POST['anecdote'];
            $specimen = $_POST['specimen'];
            $family = $_POST['family'];
            $isActive = $_POST['isActive'];
            
            
            $inputControl = [
                                $description,
                                $compo,
                                $trad_use,
                                $props,
                                $glob_prop,
                                $int_use,
                                $ext_use,
                                $other_use,
                                $toxic,
                                $anecdote,
                                $specimen
                            ];
                            
            foreach( $inputControl as $input )
            {
                if( $input === '' )
                {
                    return $input = null;
                }
            }
            
            $newData = 
                [
                  'plant_name' => $plant_name,
                  'plant_scientific_name' => $plant_sc_name,
                  'family_id' => $family,
                  'plant_origin_description' => $description,
                  'plant_composition' => $compo,
                  'plant_traditional_use' => $trad_use,
                  'plant_properties_description' => $props,
                  'plant_globals_properties' => $glob_prop,
                  'plant_internal_use' => $int_use,
                  'plant_external_use' => $ext_use,
                  'plant_other_uses' => $other_use,
                  'plant_toxicity' => $toxic,
                  'plant_anecdote' => $anecdote,
                  'plant_specimens' => $specimen,
                  'isActive' => $isActive
                ];
       
      
            $plantModel->updatePlant($newData, $_POST['plantID']);        
                
            
            header ( 'Location: index.php?route=backoffPlant&update=true' );
            exit();
            
        }
    }    
    
    
    
    public function deletePlant()
    {
        $plantModel = new \Models\Plant();
        
        if( isset( $_GET['plantID'] ))
        {
            $plantModel->deletePlant( $_GET['plantID'] );
        }
        else
        {
            header ( 'Location:index.php?route=backoffPlant&deleted=false' );
            exit(); 
        }
        
        header ( 'Location:index.php?route=backoffPlant&deleted=true' );
        exit();
        
    }
    
}