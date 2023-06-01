<?php 

require ('includes.php');
$location = new Location();

if(isset($_POST["region_id"])){  

    $curdistrict = $location->getDistrict($_POST["region_id"]);
    // Generate HTML of state options list 
    if($curdistrict != null){ 
        echo '<option value="">Select district</option>'; 
        for ($i=0; $i < sizeof($curdistrict); $i++) { 
                
            echo '<option value="'.$curdistrict[$i]['district_id'].'">'.$curdistrict[$i]['district'].'</option>';
        }
    }else{ 
        echo '<option value="">State not available</option>'; 
    } 
}
?>