<?php
session_start();
if (!isset($_SESSION['adminname'])) {
    header("Location: index.php");
    exit();
}

require_once("../includes/initialize.php");
require_once './header.php';
if (isset($_GET['id'])) {
    $bm_id = $_GET['id'];
    $show = man_power::BM_by_id($bm_id);
}
if (isset($_GET['BM_Name'])) {
    $BM_Name = $_GET['BM_Name'];
    $BM_Mobile = $_GET['BM_Mobile'];
    $BM_Emp_id = $_GET['BM_Emp_Id'];
    $field_array = array(
        'BM_Emp_Id' => $BM_Emp_id,
        'BM_Mobile' => $BM_Mobile,
        'BM_Name' => $BM_Name,
    );
    $update = new man_power();
    $update->update($field_array);
    $update2=man_power::update_bm($BM_Name,$BM_Mobile,$BM_Emp_id);
    header("location:Edit_Bm.php");
}
?>

<div class="row">
    <div class="col-lg-6 panel panel-default">
        <div class="panel panel-body">
            <form action="Edit_BM_Page.php" method="GET">
                <div class="form-group">
                    <input type="text" class="form-control" name="BM_Name" value="<?php echo $show->BM_Name; ?>"/>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="BM_Emp_Id" value="<?php echo $show->BM_Emp_Id; ?>"/>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="BM_Mobile" value="<?php echo $show->BM_Mobile; ?>"/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Update"/>
                </div>
            </form>
        </div>
    </div>
</div>






<?php require_once './footer.php'; ?>