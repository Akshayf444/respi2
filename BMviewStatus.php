<?php
require_once("./includes/initialize.php");

session_start();
if (!isset($_SESSION['bdmemp'])) {
    header("Location: index.php");
    exit();
}
$bm_empid = $_SESSION['bdm'];
if (isset($_POST['getReport'])) {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $conditions = array("WHERE rm.smsWayid = " . $bm_empid, "AND DATE_FORMAT(act.created,'%Y-%m-%d') BETWEEN '$from' AND '$to'  ");
    $result = man_power::bmViewStatus3($conditions);
} else {
    $conditions = array("WHERE rm.smsWayid = " . $bm_empid);
    $result = man_power::bmViewStatus3($conditions);
}
require_once('header.php');
?>
<script src="jquery-ui.js" type="text/javascript"></script>
<a href="BMDashboard.php"> << Back</a>

<div class="col-lg-12 col-xs-12 panel panel-default">
    <div class="panel-body">

        <form action="BMviewStatus.php" method="POST">
            <div class="form-group">
                <label class="control-label">From</label>
                <input type="text" class="form-control from" autocomplete="off" value="<?php echo isset($_POST['from']) ? $_POST['from'] : ''; ?>" name="from" placeholder="From"/>
            </div>
            <div class="form-group">
                <label class="control-label">To</label>
                <input type="text" class="form-control to" autocomplete="off" value="<?php echo isset($_POST['to']) ? $_POST['to'] : ''; ?>" name="to" placeholder="To"/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" name="getReport" value="Get Report"/>
            </div>
        </form>
    </div>
</div>
<div class="col-xs-12">
    <table class="table table-bordered table-stripped">
        <tr style="background: #5BC6DE">
            <th>No</th>
            <th>Activity Name</th>
            <th>Count</th>
        </tr>
        <?php
        if (!empty($result)) {
            $result = array_shift($result);
            ?>

            <tr>
                <td>1</td>
                <td>Doctor Converted</td>
                <td><?php echo $result->doctor_converted; ?></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Health Device Clinic</td>
                <td><?php echo $result->device_clinic; ?></td>
            </tr>
            <tr>
                <td>3</td>
                <td>RCP Drives</td>
                <td><?php echo $result->rcp_drive; ?></td>
            </tr>
            <tr>
                <td>4</td>
                <td>No. Of Rotahaler Changed</td>
                <td><?php echo $result->rotahaler; ?></td>
            </tr>
            <tr>
                <td>5</td>
                <td>RCP Made</td>
                <td><?php echo $result->rcp_made; ?></td>
            </tr>

        <?php } ?>
    </table>
</div>

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
<?php
require_once ('footer.php');
?>