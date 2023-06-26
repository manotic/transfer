<?php

$userDetail = $user->getUser($_SESSION['email']);

 $trans = $transfer->getParentsTransfer($userDetail[0]['id']);

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
    <th scope="col">Status</th>
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
        if ($trans[0]['tran_level'] == 5) {
            echo '<td>Transfer accepted!</td>';
        } elseif ($trans[0]['tran_level'] == 0) {

            echo '<td>Transfer rejected <a class="badge squire-pill bg-info" href="index.php?url=transfer_status&trans_id='.$trans[$i]['transfer_id'].'">View details</a></td>';
        } else {
            echo '<td>Transfer on progress <a class="badge squire-pill bg-info" href="index.php?url=transfer_status&trans_id='.$trans[$i]['transfer_id'].'">View deatils</td>';
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

<!-- <div class="container mt-5">
<?php 
if (isset($_GET['trans_id'])) {
    
    $tran = $transfer->getTransfer($_GET['trans_id']);

    $admin_detail = $user->getUser($tran[0]['set_by']);

    if ($admin_detail[0]['region_id'] == null) {
    
        $district = $location->getDistrict($admin_detail[0]['district_id']);
        
        echo '<p><b>Application rejected by '.$admin_detail[0]['firstname'].' '.$admin_detail[0]['lastname'].'
            of '.$district[0]['district'].' district</b></p>';
    } else if ($admin_detail[0]['region_id'] != null) {

        $region = $location->getDistrict($admin_detail[0]['region_id']);
        
        echo '<p><b>Application rejected by '.$admin_detail[0]['firstname'].' '.$admin_detail[0]['lastname'].'
            of '.$region[0]['region'].' region </b></p>';
        
    }
    
    echo '<p><b>Description: </b>'.$tran[0]['description'].' </p>';
}
?>
</div> -->