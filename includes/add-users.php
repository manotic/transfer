<?php

$districts = $location->getAllDistrict();
$region = $location->getRegions();
$users = $user->getAllUsers();

if (isset($_POST['add-user'])) {
    $user->addUser();

    header('Location: index.php?url=add-user');
}
?>
<script>
$(document).ready(function(){
    $('#cur_region').on('change', function(){
        var regionID = $(this).val();
        if(regionID){
            $.ajax({
                type:'POST',
                url:'includes/ajax.php',
                data:'region_id='+regionID,
                success:function(html){
                    $('#cur_district').html(html);
                    // $('#city').html('<option value="">Select state first</option>'); 
                }
            });
        }else{
            $('#cur_district').html('<option value="">Select region first</option>');
            // $('#city').html('<option value="">Select state first</option>'); 
        }
    });
    $('#tran_region').on('change', function(){
        var regionID = $(this).val();
        if(regionID){
            $.ajax({
                type:'POST',
                url:'includes/ajax.php',
                data:'region_id='+regionID,
                success:function(html){
                    $('#tran_district').html(html);
                    // $('#city').html('<option value="">Select state first</option>'); 
                }
            });
        }else{
            $('#tran_district').html('<option value="">Select region first</option>');
            // $('#city').html('<option value="">Select state first</option>'); 
        }
    });
});
</script>

<div class="form">
<form method="POST" class=" row g-3 col-md-8">
    <div class="form-group">
        <?php if (isset($msg)) { echo @$msg; } ?>
    </div>
    
    
    <div class="col-md-6">
        <label for="floatingInput">Select school region</label>
        <select name="region" id="cur_region" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
            <option>Select current school region</option>
            <?php 
            for ($i=0; $i < sizeof($region); $i++) { 
                
                echo '<option value="'.$region[$i]['region_id'].'">'.$region[$i]['region'].'</option>';
            }
            
            $oneDArray = array_merge(...$region);
            if ($region != null) {
                var_dump($oneDArray);
            } else {
                var_dump($region);
            }
            
            ?>
        </select>
    </div>
    <div class="col-md-6">
        <label for="floatingInput">Select school district</label>
        <select name="district" id="cur_district" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
            <!-- <option>Current school district</option> -->
        </select>
    </div>
    <div class="col-md-6 ">
        <label for="floatingInput">First name</label>
        <input type="text" name="firstname" class="form-control" id="floatingInput">
    </div>
    <div class="col-md-6 ">
        <label for="floatingInput">Last name</label>
        <input type="text" name="lastname" class="form-control" id="floatingInput">
    </div>
    <div class="mb-3 ">
        <label for="floatingInput">Email</label>
        <input type="email" name="email" class="form-control" id="floatingInput">
    </div>
    <button type="submit" class="btn btn-success col-md-6" name="add-user">Add user</button>
</form>
</div>

<div class="bd-example mt-5">
<table class="table table-striped">
    <thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Name</th>
    <th scope="col">Admin email</th>
    <th scope="col">District or region</th>
    </tr>
    </thead>
    <tbody>
<?php
$rownum = 1;

if (@$users != NULL) {
    for ($i=0; $i < sizeof($users); $i++) {

        // $admin = $user->getDistrictAdmin($districts[$i]['district_id']);
        echo '<tr>';
        echo '<th scope="row">'.$rownum.'</th>';
        echo '<td>'.@$users[$i]['firstname'].' '.@$users[$i]['lastname'].'</td>';
        echo '<td>'.@$users[$i]['email'].'</td>';
        if ($users[$i]['region_id'] != NULL) {
                
            $admin_region = $location->getRegion($users[$i]['region_id']);
            echo '<td>'.$admin_region[0]['region'].'</td>';
        } else {
                
            $admin_district = $location->getDistrict($users[$i]['district_id']);
            echo '<td>'.$admin_district[0]['district'].'</td>';
        }
        echo '</tr>';

        $rownum++;
    } 
} else {
    echo '<tr>';
    echo '<th scope="row" colspan="8">No results</th>';
    echo '</tr>';
}
?>
    </tbody>
</table>
</div>