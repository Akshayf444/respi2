<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" /><title>Respi2</title>
<<<<<<< HEAD

        <!-- Bootstrap Core CSS -->
        <link href="http://instacom.in/Cutisera/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />

        <!-- MetisMenu CSS -->
        <link href="http://instacom.in/Cutisera/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet" />

        <!-- Timeline CSS -->
        <link href="http://instacom.in/Cutisera/dist/css/timeline.css" rel="stylesheet" />

        <!-- Custom CSS -->
        <link href="http://instacom.in/Cutisera/dist/css/sb-admin-2.css" rel="stylesheet" />

        <!-- Morris Charts CSS -->
        <link href="http://instacom.in/Cutisera/bower_components/morrisjs/morris.css" rel="stylesheet" />

=======
        <script src="http://instacom.in/Cutisera/js/jquery-1.9.1.min.js"></script>
        <link href="jquery-ui.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap Core CSS -->
        <link href="http://instacom.in/Cutisera/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />

        <!-- MetisMenu CSS -->
        <link href="http://instacom.in/Cutisera/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet" />

        <!-- Timeline CSS -->
        <link href="http://instacom.in/Cutisera/dist/css/timeline.css" rel="stylesheet" />

        <!-- Custom CSS -->
        <link href="http://instacom.in/Cutisera/dist/css/sb-admin-2.css" rel="stylesheet" />

        <!-- Morris Charts CSS -->
        <link href="http://instacom.in/Cutisera/bower_components/morrisjs/morris.css" rel="stylesheet" />

>>>>>>> 2706c98f6dfc3736a6a3339d4dac04fee2034ef0
        <!-- Custom Fonts -->
        <link href="http://instacom.in/Cutisera/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" /></asp:ContentPlaceHolder>
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;background-image:url(Images/strip.png); background-repeat:no-repeat; background-size: 100% 122px;">
            <ul class="nav navbar-top-links navbar-right" style=" float:left !important">
                <a id="anchr_Home" ><img id="Image1" src="Images/screen.jpg" style="position: relative;height:10%;width: 13%;"></a> 

                <label id="lblName"  style="color:white">Welcome <?php
                    if (isset($_SESSION['bdmname'])) {
                        echo $_SESSION['bdmname'];
                    } elseif ($_SESSION['smname']) {
                        echo $_SESSION['smname'];
                    }
                    ?></label>

                <a href="logout.php"> <i class="fa fa-power-off fa-2x pull-right" style="color:red;position: relative;right: 17px;margin-top: 6%;"></i></a>
            </ul>
        </nav>