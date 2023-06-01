<?php

$userDetail = $user->getUser($_SESSION['email']);

$inreg_trans = $transfer->getInRegionTransfer($userDetail[0]['region_id']);

?>
<div class="bd-example mt-5">
<table class="table table-striped">
    <thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Students name</th>
    <th scope="col">Students level</th>
    <th scope="col">Students school</th>
    <th scope="col">Location</th>
    <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
<?php
$rownum = 1;

if (@$inreg_trans != NULL) {
    for ($i=0; $i < sizeof($inreg_trans); $i++) {

        echo '<tr>';
        echo '<th scope="row">'.$rownum.'</th>';
        echo '<td>'.$inreg_trans[$i]['firstname'].' '.$inreg_trans[$i]['lastname'].'</td>';
        echo '<td>'.$member[$i]['lastname'].'</td>';
        echo '<td>'.$member[$i]['email'].'</td>';
        echo '<td>'.$member[$i]['phonenumber'].'</td>';
        echo '<td>'.$member[$i]['position'].'</td>';
        echo '<td>'.$member[$i]['status'].'</td>';
        echo '<td><a class="badge squire-pill bg-danger" href="index.php?url=group-members&member_del='.$member[$i]['id'].'&email='.$member[$i]['email'].'">Delete</a></td>';
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