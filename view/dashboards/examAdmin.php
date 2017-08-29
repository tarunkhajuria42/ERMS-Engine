<?php
namespace view;
function examAdmin()
{
return <<<HTML
<!-- Navigation -->
    <script src="javascript/external.js"></script>
    <div id='welcome'>
        <p id='wtext' class='welcome'></p>
    </div>
    <nav id="mainNav" class="navbar static-top navbar-toggleable-md navbar-inverse">
        <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
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
                    	<a class="nav-link" href="#tab-01" aria-controls="tab-01" role="tab" data-toggle="tab">Users</a>
                	</li>   	
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-02" aria-controls="tab-02" role="tab" onclick='logout()' data-toggle="tab">Logout</a>
                    </li>   
            </ul>
        </div>
    </nav>	
    <div class='tab-content'>
    <div class="tab-pane content-wrapper py-3 active" id='tab-01'>
            <div class="container-fluid" id='container'>

                <!-- Example Tables Card -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i>Course Managers
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="courses_table1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Courses</th>
                                        <th>Users</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Courses</th>
                                        <th>Users</th>
                                    </tr>   
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div><p id='info_course1' class='text-center'</p></div>
                </div>
                </div>
                
                <div class="modal fade" id="users1" role="dialog" data-backdrop='static'>
                    <div class="modal-dialog modal-lg">
                         <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" onclick='reset1()' data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Users</h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="users_table1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Users</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody >
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Users</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        <div><button class='btn btn-info pull-right mt-2' onclick='new_user1()'>New User</button></div>
                        </div>
                            </div>
                            <div><p id='info_users1' class='text-center'></p></div>
                            <div class="modal-footer">
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
                
            </div>
            
        </div>
    <!-- /.content-wrapper -->
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>

HTML;
}	
?>
