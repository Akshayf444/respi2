<?php
require_once("./includes/initialize.php");
$errors = array();

session_start();
if (isset($_POST['submit'])) { // Form has been submitted.
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check database to see if username/password exist.
    $found_bdm = bdm::authenticate($username, $password);
    $found_ho = ho::authenticate($username, $password);
    $found_task = task::auth($username, $password);

    if ($found_bdm) {

        $_SESSION['bdm'] = $found_bdm->bdm_id;
        $_SESSION['bdmname'] = $found_bdm->bdm_name;
         $_SESSION['bdmzone'] = $found_bdm->zone;
        redirect_to("dashboard.php");
    } elseif ($found_ho) {
//        session_start();
        $_SESSION['ho'] = $found_ho->id;
        redirect_to("dashboard.php");
    } elseif ($found_task) {
//       session_start();
        $_SESSION['taskforce'] = $found_task->tfid;
         $_SESSION['tfname'] = $found_task->name;
         $_SESSION['tfzone'] = $found_task->zone;
        redirect_to("dashboard.php");
    } else {
        $message = "Incorrect Username/Password.";
        flashMessage($message, 'error');
    }
}
?>
<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Title</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="text-align: center">

                            <img  src="images/logox.png" width="45%" >

                        </div>
                        <div class="panel-body">
                            <form method="post" action="#">

                                <div class="form-group">
                                    <input type="text" class="form-control uname" placeholder="Username" name="username"/>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control pword" placeholder="Password" name="password" />
                                </div>
                                <button class="btn btn-success btn-block" type="submit" name="submit" >Sign In</button>
                                <!--<a href="#" data-toggle="modal" data-target="#forgot">Forgot Password</a>-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>    
    </body>
</html>