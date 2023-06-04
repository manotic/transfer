<?php
$regions = $location->getRegions();
if (isset($_POST['add-region'])) {

    if (!empty($_POST['region'])) {

        $location->addRegion();

        header('Location: index.php?url=region');
    }
}

// $string = "this IS ThE StrIng iN MIXED words<br>";
// ucfirst(strtolower($string));
?>


<div class="form">
<form method="POST" class=" row g-3 col-md-6">
    <div class="form-group">
        <?php if (isset($msg)) { echo @$msg; } ?>
    </div>
    <div class="mb-3">
        <label for="floatingInput">Region name</label>
        <input type="text" name="region" class="form-control" id="floatingInput">
    </div>
    <button type="submit" class="btn btn-success col-md-6" name="add-region">Add region</button>
</form>
</div>

<div class="bd-example mt-5">
<table class="table table-striped">
    <thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Region name</th>
    <th scope="col">Region admin</th>
    <th scope="col">Admin email</th>
    </tr>
    </thead>
    <tbody>
<?php
$rownum = 1;

if (@$regions != NULL) {
    for ($i=0; $i < sizeof($regions); $i++) {

        $admin = $user->getRegionAdmin($regions[$i]['region_id']);
        echo '<tr>';
        echo '<th scope="row">'.$rownum.'</th>';
        echo '<td>'.$regions[$i]['region'].'</td>';
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