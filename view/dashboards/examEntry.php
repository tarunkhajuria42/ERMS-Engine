<?php
namespace view;
function examEntry()
{
return <<<HTML
<!-- Navigation -->
    <script src="javascript/inputer.js"></script>
    <script src="javascript/tables.js"></script>
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
                        <i class="fa fa-table"></i> Checked Marks
                    </div>
                    <div class="card-block">
                    <div>
                        Course:<select id='courses_list1' class='mb-3 mr-3'>
                        </select>
                        <button onclick='select_submit1()'  class=' btn btn-info btn-sm'>Select</button></div>
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="marks_table1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Roll No</th>
                                        <th>Marks</th>
                                        <th>Subject</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    <tr>
                                        <td><input id='roll_no' type='text'></td>
                                        <td><input id='marks' type='text'></td>
                                        <td><select id='subjects_list'></select></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Roll No</th>
                                        <th>Marks</th>
                                        <th>Subject</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                           
                    </div> 
                </div>
                <div><p id='info_marks' class='text-center'></p></div>
                </div>
            <div><button id='submit_marks' class='btn btn-info pull-right mr-3' onclick='submit_marks()'>Submit</button></div>
        </div>
    </div>
    <!-- /.content-wrapper -->
    </div>

HTML;
}	
?>
