<?php
namespace view;

function principal()
{
return <<<HTML
<!-- Navigation -->
    <script src="javascript/principal.js"></script>
    <script src="javascript/tables.js"></script>
    <link href="css/admin.css" rel="stylesheet">
    <div id='welcome'>
        <p class='welcome'>Welcome Tarun</p>
    </div>
    <nav id="mainNav" class="navbar static-top navbar-toggleable-md navbar-inverse">
        <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
	<div id='header'>
		<img id='header_logo' src='images\logoWhite.png'>
		<h1 id='header_title'>Board of Technical Education</h1>
		<h2 id='header_subtitle'>Government of N.C.T. of Delhi</h2>
		<style>
			#header{
				width:100%;
				height:130px;
				background-color: #FF931E;
				}
			#header_logo{
				position:absolute;
				height:100px;
				top:20px;
				right:40px;
			}
			#header_title{	
				position:absolute;
				color:white;
				font-size:18px;
				top:45px;
				right:150px;
			}
			#header_subtitle{
				position:absolute;
				color:white;
				font-size:16px;
				top:65px;
				right:160px;

			}
		</style>
	</div>  
        <div class="collapse navbar-collapse" id="navbarmain">  
            <ul class="sidebar-nav navbar-nav nav-tabs" id='navlist'>
         			<li class="nav-item active">
                    	<a class="nav-link" href="#tab-01" aria-controls="tab-01" role="tab" data-toggle="tab">Marks</a>
                	</li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-02" aria-controls="tab-02" role="tab" data-toggle="tab">Generate Id</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-03" aria-controls="tab-03" role="tab" data-toggle="tab">Rights Management</a>
                    </li>   	
                    <li class="nav-item">
                        <a class="nav-link" onclick='logout()' href="#tab-04" aria-controls="tab-04" role="tab" data-toggle="tab">Logout</a>
                    </li>   
            </ul>
        </div>
    </nav>	
    <div class='tab-content'>
     <div class="tab-pane content-wrapper py-3 active"  id='tab-01'>
            <div class="container-fluid" id='container'>

                <!-- Example Tables Card -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Checked Marks
                    </div>
                    <div class="card-block">
                    <div>
                        Course:<select id='courses_list1' class='mb-3 mr-3'>
                            <option value='all'>All</option>
                        </select>
                        <button onclick='select_submit1()'  class=' btn btn-info btn-sm'>Select</button></div>
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="batch_table1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Subject Code</th>
                                        <th>Institute</th>
                                        <th>Course</th>
                                        <th>Internal Practical</th>
                                        <th>Internal Theory</th>
                                        <th>External Practical</th>
                                    </tr>
                                </thead>
                                <tbody >
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Subject Code</th>
                                        <th>Institute</th>
                                        <th>Course</th>
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
                </div>
                <div class="modal fade" id="marks1" role="dialog" data-backdrop='static'>
                    <div class="modal-dialog modal-lg">
                         <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" onclick='load_batch1()' data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Marks</h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="marks_table1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Roll No</th>
                                        <th>Name</th>
                                        <th>Marks</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody >
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Roll No</th>
                                        <th>Name</th>
                                        <th>Marks</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                            </div>
                            <div><p id='info_marks1' class='text-center'></p></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss='modal' onclick='load_batch1()'>Close</button>
                            </div>
                        </div>   
                    </div>
                </div>
        </div>
    <!-- /.content-wrapper -->
    <div class="tab-pane content-wrapper py-3" id='tab-02'>
        <div class="container-fluid" id='container'>

                <!-- Example Tables Card -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Ids
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="ids_table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody id='institutes_entry'>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Institutes</th>
                                        <th>Courses</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div><button class='btn btn-info pull-right' onclick='newinstitute()'>New Id</button></div>
                </div>
            
        </div>
        <div class="tab-pane content-wrapper py-3" id='tab-03'>
        <div class="container-fluid" id='container'>

                <!-- Example Tables Card -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Allotment
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="ids_table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Courses</th>
                                    </tr>
                                </thead>
                                <tbody id='institutes_entry'>
                                    <tr>
                                    <td>mayank@imfundo.io</td>
                                    <td><button class='btn btn-info pull-right'>Add/Edit</button></td>
                                    </tr>
                                </tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Email</th>
                                        <th>Courses</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div><button class='btn btn-info pull-right' onclick='newinstitute()'>New Person</button></div>
                </div>
            
        </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
    </div>
HTML;
}	
?>

