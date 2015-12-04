<?php
require_once("./includes/initialize.php");

session_start();
if (!isset($_SESSION['bdmemp'])) {
    header("Location: index.php");
    exit();
}
$bm_empid = $_SESSION['bdmemp'];
if (isset($_POST['getReport'])) {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $conditions = array("WHERE rm.BM_EMP_ID = " . $bm_empid, "AND act.created BETWEEN '$from' AND '$to'  ");
    $result = man_power::bmViewStatus($conditions);
} else {
    $conditions = array("WHERE rm.BM_EMP_ID = " . $bm_empid);
    $result = man_power::bmViewStatus($conditions);
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
                <input type="date" class="form-control from" name="from" placeholder="From"/>
            </div>
            <div class="form-group">
                <label class="control-label">To</label>
                <input type="date" class="form-control to" name="to" placeholder="To"/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Get Report"/>
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
                <td>Concept Initiated In Regular Clinic /Camp</td>
                <td><?php echo $result->regular_clinic; ?></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Concept Initiated In Regular Activations</td>
                <td><?php echo $result->regular_activation; ?></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Used Rotahaler Changed</td>
                <td><?php echo $result->Rotahaler; ?></td>
            </tr>

        <?php } ?>
    </table>
</div>

<script>
    var dateToday = new Date();
    var dates = $(".from, .to").datepicker({
        defaultDate: "+1w",
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