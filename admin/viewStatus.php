<?php
session_start();
if (!isset($_SESSION['adminname'])) {
    header("Location: index.php");
    exit();
}
require_once("../includes/initialize.php");
$SMList = man_power::SMDropdowm();

if (isset($_GET['SM_Emp_Id'])) {
    $sm_empid = $_GET['SM_Emp_Id'];
    $SMList = man_power::SMDropdowm($sm_empid);
    $conditions = array("WHERE rm.SM_EMP_ID = '$sm_empid' GROUP BY rm.BM_EMP_ID ");
    $BMList = man_power::bmViewStatus2($conditions);
    //var_dump($BMList);
}
if (isset($_GET['allIndia'])) {
    //$sm_empid = $_POST['SM_Emp_Id'];
    $conditions = array(" GROUP BY rm.BM_EMP_ID ");
    $BMList = man_power::bmViewStatus2($conditions);
}
require_once './header.php';
?>
<a href="adminDashBoard.php"> << Back </a>  <a href="BMreport.php" class="pull-right badge">GET BM REPORT</a>
<div class="col-lg-12 col-sm-12 col">
    <div class="col-xs-12">
        <form action="viewStatus.php" method="GET">
            <div class="form-group">
                <label class="control-label">Select SM</label>
                <select class="form-control" onchange="this.form.submit()" name="SM_Emp_Id">
                    <?php echo $SMList; ?>
                </select>
            </div>
        </form>
    </div>
    <div class="col-xs-12">
        <form action="viewStatus.php" method="GET">
            <label class="control-label">View All India</label><br/>
            <input type="submit" name="allIndia" value="All India" onclick="this.form.submit()" class="btn btn-primary">
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <?php if (!empty($BMList)) { ?>
            <table class="table table-bordered table-stripped" id="datatable">
                <tr style="background: #5BC6DE">
                    <th>Zone</th>
                    <th>Region</th>
                    <th>BM Name</th>
                    <th>Drs. Started Practicing Change</th>
                    <th>Rotahaler Check points</th>
                    <th>RCP Drives</th>
                    <th>No. Of Rotahaler Changed</th>
                </tr>
                <?php
                foreach ($BMList as $value) {
                    echo '<tr>'
                     . '<td>' . $value->Zone . '</td>'
                     . '<td>' . $value->Region . '</td>'
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
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/excellentexport.min.js" type="text/javascript"></script>
<?php require_once './footer.php'; ?>