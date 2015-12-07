<?php
require_once("./includes/initialize.php");

session_start();
if (!isset($_SESSION['smemp'])) {
    header("Location: index.php");
    exit();
}
$sm_empid = $_SESSION['smemp'];
if (isset($_GET['id'])) {
    $bm_emp_id = $_GET['id'];
    $topper = man_power::Activity_list($bm_emp_id);
}


require_once('header.php');
?>
<script src="jquery-ui.js" type="text/javascript"></script>
<a href="SMviewStatus.php"> << Back</a>

<div class="row">
    <div class="col-lg-12">
        <div class="col-xs-12">
            <table class="table table-bordered table-stripped">
                <tr style="background: #5BC6DE">
                    <th>BM Name</th>
                    <th>Drs. Started Practicing Change</th>
                    <th>Rotahaler Check points</th>
                    <th>RCP Drives</th>
                    <th>No of Rotahaler Changed</th>
                    <th>Date</th>
                </tr>
                <?php
                if (!empty($topper)) {
                    foreach ($topper as $value) {
                        echo '<tr>'
                        . '<td>' . $value->BM_Name . '</td>'
                        . '<td>' . $value->Practicing_Change . '</td>'
                        . '<td>' . $value->Check_Points . '</td>'
                        . '<td>' . $value->RCP_Drives . '</td>'
                        . '<td>' . $value->Rotahaler . '</td>'
                        . '<td>' . date('d-m-Y', strtotime($value->created)) . '</td>'
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