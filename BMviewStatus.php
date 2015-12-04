<?php
require_once("./includes/initialize.php");

session_start();
if (!isset($_SESSION['bdmemp'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['getReport'])) {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $conditions = array("WHERE rm.BM_EMP_ID = " . $bm_empid, "AND act.created BETWEEN '$from' AND '$to'  ");
    $result = man_power::bmViewStatus($conditions);
}
require_once('header.php');
?>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">View Report</h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 panel panel-default">
        <div class="panel panel-body">
            <form>
                <div class="form-group">
                    <label class="control-label">From</label>
                    <input type="date" class="form-control" name="from" placeholder="From"/>
                </div>
                <div class="form-group">
                    <label class="control-label">To</label>
                    <input type="date" class="form-control" name="from" placeholder="From"/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Get Report" name="getReport"/>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-xs-12">
    <table class="table table-bordered">
        <tr>
            <td>No</td>
            <td>Activity Name</td>
            <td>Count</td>
        </tr>
        <?php
        if (!empty($result)) {
            $result = array_shift($result);
            ?>

            <tr>
                <td>1</td>
                <td>Dr Started Practicing Change</td>
                <td><?php echo $result->Practicing_Change; ?></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Rotahaler Check points</td>
                <td><?php echo $result->Check_Points; ?></td>
            </tr>
            <tr>
                <td>3</td>
                <td>RCP Drives</td>
                <td><?php echo $result->RCP_Drives; ?></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Used Rotahaler Changed</td>
                <td><?php echo $result->Rotahaler; ?></td>
            </tr>

        <?php } ?>
    </table>
</div>
<?php
require_once ('footer.php');
?>