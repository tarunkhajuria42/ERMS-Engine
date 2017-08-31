<?php
namespace view;

function principal()
{
return <<<HTML
<!-- Navigation -->
    <script src="javascript/principal.js"></script>
    <link href="css/admin.css" rel="stylesheet">
      
    <nav id="mainNav" class="navbar static-top navbar-toggleable-md navbar-inverse">
        <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id='welcome'>
        <p id='wtext' class='welcome'></p>
        </div>
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
                    	<a class="nav-link" href="#tab-01" onclick='get_institute1()' aria-controls="tab-01" role="tab" data-toggle="tab">Marks</a>
                	</li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-02" onclick='get_institute2()' aria-controls="tab-02" role="tab" data-toggle="tab">Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-03" aria-controls="tab-03" role="tab" data-toggle="tab">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-04" aria-controls="tab-04" role="tab" data-toggle="tab">Choice Management</a>
                    </li>   	
                    <li class="nav-item">
                        <a class="nav-link" onclick='logout()' href="#tab-05" aria-controls="tab-05" role="tab" data-toggle="tab">Logout</a>
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
                        Semester:<select id='semester_list1' class='mb-3 mr-3'>
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
                                    <p id='max_marks'></p>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="marks_table1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Roll No</th>
                                        <th>Name</th>
                                        <th>Marks</th>
                                        <th>ID</th>
                                        <th>Comment</th>
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
                                        <th>ID</th>
                                        <th>Comment</th>
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
    <!-- *************************************************Tab 2 Manage Users ********************************--> 
   <div class="tab-pane content-wrapper py-3" id='tab-02'>
            <div class="container-fluid" id='container'>

                <!-- Example Tables Card -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i>Course Managers
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="courses_table2" cellspacing="0">
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
                    <div><p id='info_course6' class='text-center'</p></div>
                </div>
                </div>
                
                <div class="modal fade" id="users2" role="dialog" data-backdrop='static'>
                    <div class="modal-dialog modal-lg">
                         <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" onclick='reset2()' data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Users</h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="users_table2" cellspacing="0">
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
                        <div><button class='btn btn-info pull-right mt-2' onclick='new_user2()'>New User</button></div>
                        </div>
                            </div>
                            <div><p id='info_users2' class='text-center'></p></div>
                            <div class="modal-footer">
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
<!--**************************************************** Manage Students Tab3 **********************************-->
        <div class="tab-pane content-wrapper py-3" id='tab-03'>
        <div class="container-fluid" id='container'>

                <!-- Example Tables Card -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Manage Students
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="student_table3" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Courses</th>
                                        <th> Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td>mayank@imfundo.io</td>
                                    <td><button class='btn btn-info pull-right'>Add/Edit</button></td>
                                    </tr>
                                </tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Courses</th>
                                        <th>Edit</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
                <div><button class='btn btn-info pull-right' onclick='newinstitute()'>New Person</button></div>
                </div>
            
        </div>
<!--********************************************* Manage Choice Tab4 *******************************************-->
        <div class="tab-pane content-wrapper py-3" id='tab-04'>
                <div class="container-fluid" id='container'>

                        <!-- Example Tables Card -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table"></i> Choice Papers
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" id="courses_table4" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Courses</th>
                                                <th>Subjects</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Courses</th>
                                                <th>Subjects</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal fade" id="choice4" role="dialog" data-backdrop='static'>
                    <div class="modal-dialog modal-lg">
                         <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" onclick='reset4()' data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Choice Subjects</h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="choice_table4" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Selected Subjects</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody >
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Selected Subjects</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        <div><button class='btn btn-info pull-right mt-2' onclick='new_subject4()'>Add Subject</button></div>
                        </div>
                            </div>
                            <div><p id='info_users2' class='text-center'></p></div>
                            <div class="modal-footer">
                            </div>
                        </div>   
                    </div>
                </div>
        </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
    </div>
HTML;
}	
?>

