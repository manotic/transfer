<?php

$userDetail = $user->getUser($_SESSION['email']);

$trans = $transfer->getInRegionTransfers($userDetail[0]['region_id']);
?>

            <div class="col-md-6">
                <label for="floatingInput">First name</label>
                <input type="firstname" name="firstname" class="form-control" id="floatingInput" value="<?php echo @$_POST['firstname'] ?>" placeholder="John " required>
            </div>
            
            <div class="col-md-6">
                <label for="floatingInput">Last name</label>
                <input type="lastname" name="lastname" class="form-control" id="floatingInput" value="<?php echo @$_POST['lastname'] ?>" placeholder="Doe" required>
            </div>
            
<div class="bd-example mt-5">
<table class="table table-striped">
    <thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Students name</th>
    <th scope="col">Students level</th>
    <th scope="col">Students school</th>
    <th scope="col">Location</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
<?php
$rownum = 1;

if (@$trans != NULL) {
    for ($i=0; $i < sizeof($trans); $i++) {

        $region = $location->getRegion($trans[$i]['cur_region']);

        echo '<tr>';
        echo '<th scope="row">'.$rownum.'</th>';
        echo '<td>'.$trans[$i]['firstname'].' '.$trans[$i]['lastname'].'</td>';
        echo '<td>'.$trans[$i]['student_class'].'</td>';
        echo '<td>'.$trans[$i]['cur_school'].'</td>';
        echo '<td>'.$region[0]['region'].'</td>';
        if ($trans[$i]['tran_level'] == 5) {

            echo '<td>Transfer accepted!</td>';
        } elseif ($trans[$i]['tran_level'] == 0) {

            echo '<td>Transfer rejected</td>';
        } else {

            echo '<td>Transfer on progress</td>';
        }
        echo '<td><a class="badge squire-pill bg-info" href="index.php?url=view_transfer&trans_id='.$trans[$i]['transfer_id'].'">View more  </a></td>';
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