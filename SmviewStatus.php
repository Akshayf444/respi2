<?php
require_once("./includes/initialize.php");

session_start();
if (!isset($_SESSION['smemp'])) {
    header("Location: index.php");
    exit();
}
$sm_empid = $_SESSION['smemp'];

$conditions = array("WHERE act.SM_EMP_ID = '$sm_empid' GROUP BY rm.BM_EMP_ID ");
$topper = man_power::bmViewStatus($conditions);

require_once('header.php');
?>
<script src="jquery-ui.js" type="text/javascript"></script>
<a href="SMDashboard.php"> << Back</a>

<div class="row">
    <div class="col-lg-12">
        <div class="col-xs-12">
            <table class="table table-bordered table-stripped">
                <tr style="background: #5BC6DE">
                    <th>BM Name</th>
                    <th>Drs. Started Practicing Change</th>
                    <th>Rotahaler Check points</th>
                    <th>RCP Drives</th>
                    <th>No Of Rotahaler Changed</th>
                </tr>
                <?php
                if (!empty($topper)) {
                    foreach ($topper as $value) {
                        echo '<tr>'
                        . '<td><a href="Activity_list.php?id='.$value->BM_Emp_Id.'">' . $value->BM_Name . '</a></td>'
                        . '<td>' . $value->Practicing_Change . '</td>'
                        . '<td>' . $value->Check_Points . '</td>'
                        . '<td>' . $value->RCP_Drives . '</td>'
                        . '<td>' . $value->Rotahaler . '</td>'
                        . '</tr>';
                    }
                }
                ?>
            </table>
        </div>

    </div>
</div>

<?php
require_once ('footer.php');
?>