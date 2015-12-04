<?php
require_once("./includes/initialize.php");

session_start();
if (!isset($_SESSION['bdmemp'])) {
    header("Location: index.php");
    exit();
}
if (isset($_POST['Rotahaler'])) {
    $field_array = array(
        'regular_clinic' => $_POST['regular_clinic'],
        'regular_activation' => $_POST['regular_activation'],
        'Rotahaler' => $_POST['Rotahaler'],
        'smsWayid' => $_SESSION['bdm'],
        'BM_Emp_Id' => $_SESSION['bdmemp'],
        'SM_Emp_Id' => $_SESSION['sm_emp'],
        'created' => date('Y-m-d H:i:s'),
    );
    $add = new Activity();
    $query = $add->create($field_array);
    header("location:TankYou.php");
}
require_once('header.php');
?>
<a href="BMDashboard.php"> << Back</a>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Add Detail</h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <form action="Add_detail.php" method="POST">
                <div class="panel-body"> 
                    <div class="form-group">
                        <input type="number" name="regular_clinic" class="form-control" placeholder="Enter Concept Initiated In Regular Clinic /Camps" required="">
                    </div>
                    <div class="form-group">
                        <input type="number" name="regular_activation" class="form-control" placeholder="Enter Concept Initiated In Regular Activations" required="">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="Rotahaler" placeholder="No.of  Rotahaler Changed" required="">
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