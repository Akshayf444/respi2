<?php
session_start();
if (!isset($_SESSION['adminname'])) {
    header("Location: index.php");
    exit();
}
require_once("../includes/initialize.php");
$SMList = man_power::SMDropdowm();

if (isset($_POST['SM_Emp_Id'])) {
    $sm_empid = $_POST['SM_Emp_Id'];
    $conditions = array("WHERE rm.SM_EMP_ID = '$sm_empid' GROUP BY act.BM_EMP_ID ");
    $BMList = man_power::bmViewStatus2($conditions);
    //var_dump($BMList);
}
require_once './header.php';
?>
<a href="adminDashBoard.php"> << Back </a>
<div class="col-lg-12 col-sm-12 col">
    <form action="viewStatus.php" method="POST">
        <div class="form-group">
            <label class="control-label">Select SM</label>
            <select class="form-control" onchange="this.form.submit()" name="SM_Emp_Id">
                <?php echo $SMList; ?>
            </select>
        </div>
    </form>
</div>
<div class="row">
    <div class="col-lg-12 col-xs-12">
        <?php if (!empty($BMList)) { ?>
            <table class="table table-bordered table-stripped">
                <tr style="background: #5BC6DE">
                    <th>BM Name</th>
                    <th>Drs. Started Practicing Change</th>
                    <th>Rotahaler Check points</th>
                    <th>RCP Drives</th>
                    <th>No. Of Rotahaler Changed</th>
                </tr>
                <?php
                foreach ($BMList as $value) {
                    echo '<tr>'
                    . '<td><a href="Activity_list.php?id=' . $value->BM_Emp_Id . '">' . $value->BM_Name . '</a></td>'
                    . '<td>' . $value->Practicing_Change . '</td>'
                    . '<td>' . $value->Check_Points . '</td>'
                    . '<td>' . $value->RCP_Drives . '</td>'
                    . '<td>' . $value->Rotahaler . '</td>'
                    . '</tr>';
                }
                ?>
            </table>
        <?php } ?>
    </div>
</div>
<?php require_once './footer.php'; ?>