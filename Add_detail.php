<?php
require_once("./includes/initialize.php");
if (isset($_POST['Rotahaler'])) {
    
}
?>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Add Detail</h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <form action="Add_detail.php" method="POST">
                <div class="panel-body"> 
                    <div class="form-group">
                        <input type="number" name="Practicing_Change" class="form-control" placeholder="Dr Started Practicing Change" required="">
                    </div>
                    <div class="form-group">
                        <input type="number" name="Check_Points" class="form-control" placeholder="Rotahaler Check Points" required="">
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" name="RCP_Drives" placeholder="RCP Drives" required="">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="Rotahaler" placeholder="No.of  Rotahaler Changed" required="">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary "  name="save" value="Submit" placeholder="No of Rx">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>