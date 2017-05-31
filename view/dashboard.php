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
         			<li class="nav-item active">
                    	<a class="nav-link" href="#">abc</a>
                	</li>	
            </ul>
        </div>
    </nav>	

    <div class="content-wrapper py-3">
        <div class="container-fluid">

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
                                    <th>Roll No</th>
                                    <th>Name</th>
                                    <th>Internal Practical</th>
                                    <th>Internal Theory</th>
                                    <th>External Practical</th>
                                    <th>Roll</th>
                                    <th>Mali</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id='row01'>
                                    <td >Y></td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td><input type='button' name='abc' ></td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>Y</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td><input type='text' text='as'></td>
                                    <td><input type='text' text='as'></td>
                                    <td><input type='text' text='as'></td>
                                    <td><input type='text' text='as'></td>
                                    <td><input type='text' text='as'></td>
                                    <td><input type='text' text='as'></td>
                                    <td><input type='text' text='as'></td>
                                </tr>    
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Roll No</th>
                                    <th>Name</th>
                                    <th>Internal Practical</th>
                                    <th>Internal Theory</th>
                                    <th>External Practical</th>
                                    <th>Start date</th>
                                    <th>Roll</th>
                                    <th>Mali</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                        <button id='add' name='add' data-toggle="modal" data-target="#myModal">Add</button>
                </div>
                <div class="card-footer small text-muted">
                    CopyRight Board of Technical Education
                </div>
            </div>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog" id="modalcon">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div >
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 >Modal Header</h4>
                    </div>
                    <div class="modal-body">
                           
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
                                    <th>Roll No</th>
                                    <th>Name</th>
                                    <th>Internal Practical</th>
                                    <th>Internal Theory</th>
                                    <th>External Practical</th>
                                    <th>Roll</th>
                                    <th>Mali</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id='row01'>
                                    <td >Y></td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td><input type='button' name='abc' ></td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>N</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td>Y</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                    <td>adsd</td>
                                </tr>
                                <tr>
                                    <td><input type='text' text='as'></td>
                                    <td><input type='text' text='as'></td>
                                    <td><input type='text' text='as'></td>
                                    <td><input type='text' text='as'></td>
                                    <td><input type='text' text='as'></td>
                                    <td><input type='text' text='as'></td>
                                    <td><input type='text' text='as'></td>
                                </tr>    
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Roll No</th>
                                    <th>Name</th>
                                    <th>Internal Practical</th>
                                    <th>Internal Theory</th>
                                    <th>External Practical</th>
                                    <th>Start date</th>
                                    <th>Roll</th>
                                    <th>Mali</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                        <button id='add' name='add' data-toggle="modal" data-target="#myModal">Add</button>
                </div>
                <div class="card-footer small text-muted">
                    CopyRight Board of Technical Education
                </div>
            </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                  
                </div>
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

</body>

</html>
