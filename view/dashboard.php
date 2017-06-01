<?php
/* Dashboard generator

Examination Record Management System

author:tarunkhajuria42@gmail.com

*/
namespace view;
require('misc.php');	
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
            <link href="css/dashboard.css" rel="stylesheet">
		</head>

<body id="page-top" onload='checkstatus()'>

    <!-- Navigation -->
    <nav id="mainNav" class="navbar static-top navbar-toggleable-md navbar-inverse">
        <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
        echo(misc\header());
        ?>
        <div class="collapse navbar-collapse" id="navbarmain">  
            <ul class="sidebar-nav navbar-nav" id='navlist'>
         			<li class="nav-item active">
                    	<a class="nav-link" href="#">Marks</a>
                	</li>	
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Logout</a>
                    </li>   
            </ul>
        </div>
    </nav>	

    <div class="content-wrapper py-3">
        <div class="container-fluid" id='container'>

            <!-- Breadcrumbs -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">My Dashboard</li>
            </ol>

           
                    
                       
            <!-- Example Tables Card -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Checked Marks
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Course</th>
                                    <th>Batch</th>
                                    <th>Internal Practical</th>
                                    <th>Internal Theory</th>
                                    <th>External Practical</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td >AA130</td>
                                    <td>Architectural Assistantship</td>
                                    <td>2018</td>
                                    <td>N</td>
                                    <td>N</td>
                                    <td>N</td>
                                </tr>
                                <tr>
                                    <td >AA138</td>
                                    <td>Architectural Assistantship</td>
                                    <td>2018</td>
                                    <td>N</td>
                                    <td>N</td>
                                    <td>N</td>
                                </tr>
                                <tr>
                                    <td >AA138</td>
                                    <td>Architectural Assistantship</td>
                                    <td>2018</td>
                                    <td>N</td>
                                    <td>N</td>
                                    <td>N</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Course</th>
                                    <th>Batch</th>
                                    <th>Internal Practical</th>
                                    <th>Internal Theory</th>
                                    <th>External Practical</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                       
                </div> 
            </div>
            <div class="card mb-3" id='editmarks'>
                <div class="card-header">
                    <i class="fa fa-table"></i> Enter Marks : Internal Practical
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Roll No</th>
                                    <th>Name</th>
                                    <th>Entry 1</th>
                                    <th>Entry 2</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td >11234</td>
                                    <td>Tarun Khajuria</td>
                                    <td id='e1_11234' class='entry1'><input id='i1_11234' type='text'></td>
                                    <td id='e2_11234' class='entry2'></td>
                                </tr>
                                <tr>
                                    <td >11237</td>
                                    <td>Vishal Sengar</td>
                                    <td id='e1_11237' class='entry1'><input id='i1_11237' type='text'></td>
                                    <td id='e2_11237' class='entry2'></td>
                                </tr>
                                <tr>
                                    <td >11534</td>
                                    <td>Manas Mehta</td>
                                    <td id='e1_11534' class='entry1'><input id='i1_11534' type='text'></td>
                                    <td id='e2_11534' class='entry2'></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Roll No</th>
                                    <th>Name</th>
                                    <th>Entry 1</th>
                                    <th>Entry 2</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                        <button id='submitButton' name='Submit' class='pull-right mr-2' onclick='submit1()'>Submit</button>
                </div>
                <div class="card-footer small text-muted">
                    CopyRight Board of Technical Education
                </div>
            </div>
            
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
    <script src="javascript/tables.js"></script>
</body>

</html>
