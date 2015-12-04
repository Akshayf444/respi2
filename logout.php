<?php
session_start();
session_destroy();
    $_SESSION['bdm'] = null;
      $_SESSION['ho'] = null;
        $_SESSION['taskforce'] = null;
    header("Location:index.php");

echo '<script>window.location="index.php"</script>';
?>