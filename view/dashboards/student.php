<?php
namespace view;
function student()
{
return <<<HTML
<!-- Navigation -->
    
    <script src="javascript/student.js"></script>
    
    
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
                    	<a class="nav-link" href="#tab-01" aria-controls="tab-01" role="tab" data-toggle="tab">Marks</a>
                	</li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-02" onclick='logout()' aria-controls="tab-02" role="tab" data-toggle="tab">Logout</a>
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
                    <i class="fa fa-table"></i> Results
                </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" id="student_table1" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Semester</th>                                
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div> 
            </div>
           
     <div id="exam_form" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick='get_contents()' data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">Generate Admit Card</h4>
                </div>
                <form id='main_form' action="http://localhost/ERMS-Engine/erms/index.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            
                                <div class="col-md-8">
                                    <h5>Regular Subjects</h5>
                                    <div class="form-group" id='regular'>
                                    </div>
                                    <h5>Electives</h5>
                                    <div class="form-group" id='elective'>
                                    </div>
                                    <h5>Back Papers</h5>
                                    <div class="form-group" id='back'>
                                    </div>
                                    <h5>Improvement Papers</h5>
                                    <div class="form-group" id='improvement'>
                                    </div>
                                    <select id='improvement_papers'></select><button type='button' id='add_button' onclick='add_improvement()' class='btn btn-info ml-2'>Add</button>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label>Applicant's Photograph</label>
                                        <input type="file" name="picToUpload" id="picToUpload">
                                    </div>
                                    <br>
                                    <div>
                                        <label>Applicant's Signature</label>
                                        <input type="file" name="sigToUpload" id="sigToUpload">
                                    </div>
                                    <div class='mt-5'>
                                        <h5>Total Fees:</h5> <p id='fees'></p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p id='message'></p>
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick='get_contents()' >Close</button>
                    </div>
             </form>
            </div>
            
        </div>
    </div>   
    </div>
    </div>
HTML;
}	
?>
