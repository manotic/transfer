<?php

$districts = $location->getAllDistrict();
$region = $location->getRegions();

if (isset($_POST['add-district'])) {

    if (!empty($_POST['district'])) {

        $location->addDistrict();

        header('Location: index.php?url=district');
    }
}
?>


<div class="form">
<form method="POST" class=" row g-3 col-md-6">
    <div class="form-group">
        <?php if (isset($msg)) { echo @$msg; } ?>
    </div>
    
    <div class="col-md-6">
        <label for="floatingInput">Select school region</label>
        <select name="region_id" id="region_id" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
            <option>Select region</option>
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
    <div class="mb-3">
        <label for="floatingInput">District name</label>
        <input type="text" name="district" class="form-control" id="floatingInput">
    </div>
    <button type="submit" class="btn btn-success col-md-6" name="add-district">Add district</button>
</form>
</div>

<div class="bd-example mt-5">
<table class="table table-striped">
    <thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">District name</th>
    <th scope="col">District admin</th>
    <th scope="col">Admin email</th>
    </tr>
    </thead>
    <tbody>
<?php
$rownum = 1;

if (@$districts != NULL) {
    for ($i=0; $i < sizeof($districts); $i++) {

        $admin = $user->getDistrictAdmin($districts[$i]['district_id']);
        echo '<tr>';
        echo '<th scope="row">'.$rownum.'</th>';
        echo '<td>'.$districts[$i]['district'].'</td>';
        echo '<td>'.@$admin[0]['firstname'].' '.@$admin[0]['lastname'].'</td>';
        echo '<td>'.@$admin[0]['email'].'</td>';
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