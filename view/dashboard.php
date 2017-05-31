<?php
/* Dashboard generator

Examination Record Management System

author:tarunkhajuria42@gmail.com

*/
namespace view;
require('misc.php');	
if(true)
{
?>

	<!DOCTYPE html>
		<html lang="en">

		<head>

		    <meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		    <meta name="description" content="">
		    <meta name="author" content="">
		    <title>DashBoard</title>

		    <!-- Bootstrap core CSS -->
		    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		    <!-- Custom fonts for this template -->
		    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

		    <!-- Plugin CSS -->
		    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

		    <!-- Custom styles for this template -->
		    <link href="css/sb-admin.css" rel="stylesheet">

		</head>

<body id="page-top" onload='gDashboard()'>

    <!-- Navigation -->
    <nav id="mainNav" class="navbar static-top navbar-toggleable-md navbar-inverse">
        <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
        echo(misc\header());
        ?>
        <div class="collapse navbar-collapse" id="navbarmain">  
            <ul class="sidebar-nav navbar-nav">
         			<li class="nav-item ">
                    	<a class="nav-link" href="#"></a>
                	</li>	
            </ul>
        </div>
    </nav>	

    <div class="content-wrapper py-3">
    </div>
    <!-- /.content-wrapper -->

    <a class="scroll-to-top rounded" href="#    page-top">
        <i class="fa fa-chevron-up"></i>
    </a>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/sb-admin.min.js"></script>

</body>

</html>
