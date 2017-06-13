<?php
namespace view;
function student()
{
return <<<HTML
<!-- Navigation -->
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
                        <a class="nav-link" href="#tab-02" aria-controls="tab-02" role="tab" data-toggle="tab">Admit Card</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-02" onclick='logout()' aria-controls="tab-04" role="tab" data-toggle="tab">Logout</a>
                    </li>   	
            </ul>
        </div>
    </nav>	
    <div class='tab-content'>
    <div class="tab-pane content-wrapper py-3 active" id='tab-01'>
        <div class="container-fluid" id='container'>

            <!-- Breadcrumbs -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">My Dashboard</li>
            </ol>      
            <!-- Example Tables Card -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Results
                </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" id="dataTable1" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Semester</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id='subjects_admin'>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Semester</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                       
                </div> 
            </div>
           
        <div class="card-footer small text-muted">
            CopyRight Board of Technical Education
        </div>
    </div>
    <!--Tab -->
    <div class="tab-pane content-wrapper py-3 active" id='tab-02'>
        <div class="container-fluid" id='container'>


        <h5>Inactive till session updated by admin</h5>
            
        <div class="card-footer small text-muted">
            CopyRight Board of Technical Education
        </div>
    </div>
    <!--Tab -->
    </div>
    <!-- /.content-wrapper -->
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>

HTML;
}	
?>
