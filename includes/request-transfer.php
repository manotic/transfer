<?php 

$region = $location->getRegions();

if(isset($_POST['transfer'])) {

    $msg = $transfer->saveTransfer();

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
    </head>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Student transfer form</h2>
</div>

<div class="form mb-5">
<form method="POST" class=" row g-3" enctype = "multipart/form-data">
    <div class="form-group">
        <?php if (isset($msg)) { echo @$msg; } ?>
    </div>
    <!-- <input type="hidden" name="id" value="<?php echo @$group[0]['id']; ?>"> -->
    <div class="col-md-4 mb-3">
        <label for="floatingInput">Students first name</label>
        <input type="text" name="firstname" class="form-control" id="floatingInput">
    </div>
    <div class="col-md-4 mb-3">
        <label for="floatingInput">Students middle name</label>
        <input type="text" name="middlename" class="form-control" id="floatingInput">
    </div>
    <div class="col-md-4">
        <label for="floatingInput">Students last name</label>
        <input type="text" name="lastname" class="form-control" id="floatingInput">
    </div>
    <div class="col-md-6">
        <label for="floatingInput">Students date of birth</label>
        <input type="date" name="birthdate" class="form-control" id="floatingInput">
    </div>
    <div class="col-md-6">
        <label for="floatingInput">Students class</label>
        <select name="student_class" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
            <option>Select students class level</option>
            <?php
            for ($i=1; $i < 7; $i++) { 
                
                echo '<option value="CLASS '.$i.'">CLASS '.$i.'</option>';
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="floatingInput">Current school</label>
        <input type="text" name="cur_school" class="form-control" id="floatingInput">
    </div>
    <div class="col-md-6">
        <label for="floatingInput">Select school region</label>
        <select name="cur_region" id="cur_region" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
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
        <select name="cur_district" id="cur_district" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
            <!-- <option>Current school district</option> -->
        </select>
    </div>
    <div class="mb-3">
        <label for="floatingInput">Transfer school</label>
        <input type="text" name="tran_school" class="form-control" id="floatingInput">
    </div>
    <div class="col-md-6">
        <label for="floatingInput">Select school region</label>
        <select name="tran_region" id="tran_region" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
            <option>Select transfer school region</option>
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
        <select name="tran_district" id="tran_district" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
            <!-- <option>Transfer school district</option> -->
        </select>
    </div><div class="mb-3">
          <input type="file" name="upload" class="form-control form-control-md" aria-label="Small file input example">
        </div>
    <button class="w-100 btn btn-lg btn-success" type="submit" name="transfer">Apply Transfer</button>
</form>
</div>