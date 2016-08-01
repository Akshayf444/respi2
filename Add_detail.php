<?php
require_once("./includes/initialize.php");

session_start();
if (!isset($_SESSION['bdmemp'])) {
    header("Location: index.php");
    exit();
}
if (isset($_POST['rotahaler'])) {
    $field_array = array(
        'doctor_converted' => $_POST['doctor_converted'],
        'device_clinic' => $_POST['device_clinic'],
        'rcp_made' => $_POST['rcp_made'],
        'rcp_drive' => $_POST['rcp_drive'],
        'rotahaler' => $_POST['rotahaler'],
        'smsWayid' => $_SESSION['bdm'],
        'BM_Emp_Id' => $_SESSION['bdmemp'],
        'SM_Emp_Id' => $_SESSION['sm_emp'],
        'created_at' => date('Y-m-d H:i:s'),
    );
    $add = new Activity2();
    $query = $add->create($field_array);
    header("location:ThankYou.php");
}
require_once('header.php');
?>
<a href="BMDashboard.php"> << Back</a>
<!--<div class="row">
    <div class="col-lg-12">
        
        <h3>Add Detail</h3>
    </div>
</div>-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <form action="Add_detail.php" method="POST">
                <div class="panel-heading">Enter Details For Reporting TMs</div>
                <div class="panel-body"> 
                    <div class="form-group">
                        <input type="number" name="doctor_converted" class="form-control" placeholder="Doctor Converted" required="">
                    </div>
                    <div class="form-group">
                        <input type="number" name="device_clinic" class="form-control" placeholder="Healthy Device Clinics" required="">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="rcp_made" placeholder="RCP Made" required="">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="rcp_drive" placeholder="RCP Drive" required="">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="rotahaler" placeholder="Rotahaler Changed" required="">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary "  name="save" value="Submit" placeholder="No of Rx">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once ('footer.php');
?>