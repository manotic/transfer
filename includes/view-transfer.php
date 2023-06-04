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

if (isset($_POST['update-transfer'])) {

  $transfer->updateTransfer($tran[0]['transfer_id'], $trans_admin);

  header('Location: index.php?url=view_transfer&trans_id='.$_GET['trans_id']);
}
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Student transfer details</h2>
</div>

<div class="container-fluid">
  <h2 class="h5">Re: STUDENT TRANFER</h2>
  <p>Please refer to the heading above as it describe about the request for student transfer. 
    The transfer and students details are as explained below</p>
  <p><b>Students name: </b><?php echo $tran[0]['firstname'].' '.$tran[0]['lastname']; ?></p>
  <p><b>Transfer from: </b><?php echo $tran[0]['cur_school']; ?></p>
  <p><b>Found in: </b><?php echo $cur_district[0]['district'].', '.$cur_region[0]['region']; ?></p>
  <p><b>Transfer to: </b><?php echo $tran[0]['tran_school']; ?></p>
  <p><b>Found in: </b><?php echo $tran_district[0]['district'].', '.$tran_region[0]['region']; ?></p>
</div>

<?php 
if ($cur_district[0]['district_id'] == $userDetail[0]['district_id'] && $tran[0]['tran_level'] == 1) {
?>
<form method="POST" class=" row g-3 mt-3">
  <input type="hidden" name="tran_level" value="<?php echo $tran[0]['tran_level']; ?>">
  <input type="hidden" name="status" value="<?php echo $tran[0]['status']; ?>">
    <div class="input-group col-4">
        <span class="input-group-text">Description</span>
        <textarea name="description" class="form-control" aria-label="With textarea" placeholder="Type reasons or suggestion if you reject"></textarea>
    </div>
    <div class="col-md-6 ">
        <label for="floatingInput">Students class</label>
        <select name="choice" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
            <option value="accept">Accept transfer</option>
            <option value="reject">Reject transfer</option>
        </select>
    </div>
    <button class="w-100 btn btn-lg btn-success" type="submit" name="update-transfer">Save selection</button>
</form>
</div>
<?php 
} elseif ($tran_district[0]['district_id'] == $userDetail[0]['district_id'] && $tran[0]['tran_level'] == 4) { ?>

<form method="POST" class=" row g-3 mt-3">
  <input type="hidden" name="tran_level" value="<?php echo $tran[0]['tran_level']; ?>">
  <input type="hidden" name="status" value="<?php echo $tran[0]['status']; ?>">
    <div class="input-group col-4">
        <span class="input-group-text">Description</span>
        <textarea name="description" class="form-control" aria-label="With textarea" placeholder="Type reasons or suggestion if you reject"></textarea>
    </div>
    <div class="col-md-6 ">
        <label for="floatingInput">Students class</label>
        <select name="choice" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
            <option value="accept">Accept transfer</option>
            <option value="reject">Reject transfer</option>
        </select>
    </div>
    <button class="w-100 btn btn-lg btn-success" type="submit" name="update-transfer">Save selection</button>
</form>
</div>
<?php 
} elseif ($tran[0]['cur_region'] == $userDetail[0]['region_id'] && $tran[0]['tran_level'] == 2) {
  ?>
  <form method="POST" class=" row g-3 mt-3">
  <input type="hidden" name="tran_level" value="<?php echo $tran[0]['tran_level']; ?>">
  <input type="hidden" name="status" value="<?php echo $tran[0]['status']; ?>">
    <div class="input-group col-4">
        <span class="input-group-text">Description</span>
        <textarea name="description" class="form-control" aria-label="With textarea" placeholder="Type reasons or suggestion if you reject"></textarea>
    </div>
    <div class="col-md-6 ">
        <label for="floatingInput">Students class</label>
        <select name="choice" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
            <option value="accept">Accept transfer</option>
            <option value="reject">Reject transfer</option>
        </select>
    </div>
    <button class="w-100 btn btn-lg btn-success" type="submit" name="update-transfer">Save selection</button>
</form>
<?php
} elseif ($tran[0]['tran_region'] == $userDetail[0]['region_id'] && $tran[0]['tran_level'] == 3) {
?>
<form method="POST" class=" row g-3 mt-3">
  <input type="hidden" name="tran_level" value="<?php echo $tran[0]['tran_level']; ?>">
  <input type="hidden" name="status" value="<?php echo $tran[0]['status']; ?>">
    <div class="input-group col-4">
        <span class="input-group-text">Description</span>
        <textarea name="description" class="form-control" aria-label="With textarea" placeholder="Type reasons or suggestion if you reject"></textarea>
    </div>
    <div class="col-md-6 ">
        <label for="floatingInput">Students class</label>
        <select name="choice" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
            <option value="accept">Accept transfer</option>
            <option value="reject">Reject transfer</option>
        </select>
    </div>
    <button class="w-100 btn btn-lg btn-success" type="submit" name="update-transfer">Save selection</button>
</form>
<?php
} elseif ($tran[0]['tran_level'] == 0) {

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
<div class="container mt-5">
<?php 
?>
</div>

