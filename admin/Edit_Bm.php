<?php
session_start();
if (!isset($_SESSION['adminname'])) {
    header("Location: index.php");
    exit();
}

require_once("../includes/initialize.php");
require_once './header.php';
$show = man_power::BMList();


?>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered table-stripped">
            <tr>
                <th>Bm Name</th>
                <th>Bm Id</th>
                <th>Bm Mobile</th>
                <th>Edit</th>
            </tr>
            <?php
            if (!empty($show)) {
                foreach ($show as $sh) {
                    ?>            
                    <tr>
                        <td><?php echo $sh->BM_Name?></td>
                    <td><?php echo $sh->BM_Emp_Id?></td>
                    <td><?php echo $sh->BM_Mobile?></td>
                    <td><a href="Edit_BM_Page.php?id=<?php echo $sh->BM_Emp_Id?>">EDIT</a></td>
                    </tr>
                <?php }
            } ?>
                    
        </table>
    </div>
</div>






<?php require_once './footer.php'; ?>