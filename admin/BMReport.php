<?php
session_start();
if (!isset($_SESSION['adminname'])) {
    header("Location: index.php");
    exit();
}
require_once("../includes/initialize.php");
$SMList = man_power::SMDropdowm();


//$sm_empid = $_POST['SM_Emp_Id'];
$conditions = array(" GROUP BY rm.BM_EMP_ID ");
$BMList = man_power::bmViewStatus2($conditions);
if (isset($_GET['from']) && isset($_GET['to'])) {
    $from = $_GET['from'];
    $to = $_GET['to'];
    $conditions = array(" WHERE DATE_FORMAT(act.created,'%Y-%m-%d') BETWEEN '$from' AND '$to' ", " GROUP BY rm.BM_EMP_ID ");
    $BMList = man_power::bmViewStatus2($conditions);
}
require_once './header.php';
?>
<a href="viewstatus.php"> << Back </a>

<div class="row">
    <div class="col-lg-2">
        <a download="RespiBMReport.xls" class="btn btn-success" href="#" onclick="return ExcellentExport.excel(this, 'datatable', 'Sheeting');">Export to Excel</a>
    </div>
    <form action="#" method="get" >
        <div class="col-lg-2">
            <input type="text" name="from" value="<?php
            if (isset($_GET['from'])) {
                echo $_GET['from'];
            }
            ?>" class="form-control from" placeholder="from">
        </div>
        <div class="col-lg-2">
            <input type="text" name="to" value="<?php
            if (isset($_GET['to'])) {
                echo $_GET['to'];
            }
            ?>" class="form-control to" placeholder="to">
        </div>
        <div class="col-lg-2">
            <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Get Report">
        </div>
    </form>
</div>
<div class="row">
    <div class="col-lg-12 col-xs-12">
        <?php if (!empty($BMList)) { ?>
            <table class="table table-bordered table-stripped" id="datatable">
                <tr >
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
                    . '<td>' . $value->BM_Name . '</td>'
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

<script src="../js/excellentexport.min.js" type="text/javascript"></script>
<script>

            var dateToday = new Date();
            var dates = $(".from, .to").datepicker({
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: "yy-mm-dd",
                showOtherMonths: true,
                selectOtherMonths: true
            });


</script>
<?php require_once './footer.php'; ?>