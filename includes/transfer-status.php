<?php 
$tran = $transfer->getTransfer($_GET['trans_id']);
$cur_region = $location->getRegion($tran[0]['cur_region']);
$tran_region = $location->getRegion($tran[0]['tran_region']);

$cur_district = $location->getDistrict($tran[0]['cur_district']);
$tran_district = $location->getDistrict($tran[0]['tran_district']);

$userDetail = $user->getUser($_SESSION['email']);


if ($userDetail[0]['district_id'] == NULL) {

  $trans_admin = 'region';
} else if ($userDetail[0]['district_id'] != NULL) {

  $trans_admin = 'district';
}

switch ($tran[0]['tran_level']) {
    case 1:
        $level = 0;
        break;
    case 2:
        $level = 25;
        break;
    case 3:
        $level = 50;
        break;
    case 4:
        $level = 75;
        break;
    case 5:
        $level = 100;
        break;
    default:
        $level = 101;
        break;
}
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Student transfer details</h2>
</div>
<div class="progress mb-3">
    <?php
    if ($level != 101) {

        echo '<div class="progress-bar bg-success w-'.$level.'" role="progressbar" aria-valuenow="'.$level.'" aria-valuemin="0" aria-valuemax="100">'.$level.'%</div>';
    } else if($level == 101) {
        echo '<div class="progress-bar bg-danger w-'.$level - 1 .'" role="progressbar" aria-valuenow="'.$level - 1 .'" aria-valuemin="0" aria-valuemax="100">'.$level - 1 .'%</div>';
    }
    ?>
</div>
<div class="container-fluid">
  <p><b>Students name: </b><?php echo $tran[0]['firstname'].' '.$tran[0]['middlename'].' '.$tran[0]['lastname']; ?></p>
  <p><b>Born in : </b><?php echo date('d-M-Y', strtotime($tran[0]['birthdate'])); ?></p>
  <p><b>Transfer from: </b><?php echo $tran[0]['cur_school']; ?></p>
  <p><b>Found in: </b><?php echo $cur_district[0]['district'].', '.$cur_region[0]['region']; ?></p>
  <p><b>Transfer to: </b><?php echo $tran[0]['tran_school']; ?></p>
  <p><b>Found in: </b><?php echo $tran_district[0]['district'].', '.$tran_region[0]['region']; ?></p>
  <p><b>Attachments: </b><a href="uploads/<?php echo $tran[0]['attach'];?>" target="blank">View attachments</a></p>
</div>
<?php
if ($tran[0]['tran_level'] == 0) {

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
<?php
}?> 

