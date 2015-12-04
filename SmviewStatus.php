<?php

require_once("./includes/initialize.php");

session_start();
if (!isset($_SESSION['smemp'])) {
    header("Location: index.php");
    exit();
}
$sm_empid = $_SESSION['smemp'];
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
            <th>Dr Started Practicing Change</th>
            <th>Rotahaler Check points</th>
            <th>RCP Drives</th>
            <th>Used Rotahaler Changed</th>
        </tr>
        

            

        
    </table>
</div>

    </div>
</div>

<?php

require_once ('footer.php');
?>