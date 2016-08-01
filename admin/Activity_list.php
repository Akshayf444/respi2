<?php
require_once("../includes/initialize.php");

session_start();
if (!isset($_SESSION['adminname'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $bm_emp_id = $_GET['id'];
    $topper = man_power::Activity_list2($bm_emp_id);
}


require_once('header.php');
?>
<script src="jquery-ui.js" type="text/javascript"></script>
<a href="viewStatus.php"> << Back</a>

<div class="row">
    <div class="col-lg-12">
        <div class="col-xs-12">
            <table class="table table-bordered table-stripped">
                <tr style="background: #5BC6DE">
                    <th>BM Name</th>
                    <th>Doctor Converted</th>
                    <th>Health Device Clinic</th>
                    <th>RCP Drives</th>
                    <th>No of Rotahaler Changed</th>
                    <th>RCP Made</th>
                    <th>Date</th>
                </tr>
                <?php
                if (!empty($topper)) {
                    foreach ($topper as $value) {
                        echo '<tr>'
                        . '<td>' . $value->BM_Name . '</td>'
                        . '<td>' . $value->doctor_converted . '</td>'
                        . '<td>' . $value->device_clinic . '</td>'
                        . '<td>' . $value->rcp_drive . '</td>'
                        . '<td>' . $value->rotahaler . '</td>'
                        . '<td>' . $value->rcp_made . '</td>'
                        . '<td>' . date('d-m-Y', strtotime($value->created_at)) . '</td>'
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