<?php
require_once("./includes/initialize.php");

session_start();
if (!isset($_SESSION['bdmemp'])) {
    header("Location: index.php");
    exit();
}
$sm_empid = $_SESSION['bdmemp'];



require_once('header.php');
?>
<script src="jquery-ui.js" type="text/javascript"></script>
<a href="Add_detail.php"> << Back</a>

<div class="row">
    
    <div class="col-lg-12">
        <div class="col-xs-3"></div>
        <div class="col-xs-6 panel panel-default">
            <div align="center" class="panel panel-body">
                <h2>Thank You</h2>
            </div>
        </div>

    </div>
</div>

<?php
require_once ('footer.php');
?>