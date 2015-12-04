<?php
require_once("./includes/initialize.php");

session_start();
if (!isset($_SESSION['bdmemp'])) {
    header("Location: index.php");
    exit();
}
require_once('header.php');
?>
<script src="jquery-ui.js" type="text/javascript"></script>
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
</div>
<script>
    var dateToday = new Date();
    var dates = $(".from, .to").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
    });
</script>
<?php 
require_once ('footer.php');
?>