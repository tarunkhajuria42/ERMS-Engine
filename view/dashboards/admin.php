<?php
namespace view;
function admin()
{
return <<<HTML
<!-- Navigation -->
    <script src="javascript/admin.js"></script>
    <script src="javascript/tables.js"></script>
    <link href="css/admin.css" rel="stylesheet">
    <div id='welcome' onload='init()'>
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
                        <a class="nav-link" href="#tab-01" aria-controls="tab-01" role="tab" data-toggle="tab">Manage Institutes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-02" aria-controls="tab-02" role="tab" data-toggle="tab">Manage Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-03" aria-controls="tab-02" role="tab" data-toggle="tab">Manage Exams</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-04" aria-controls="tab-02" role="tab" data-toggle="tab">Manage Session</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-05" onclick='logout()' aria-controls="tab-02" role="tab" data-toggle="tab">Log Out</a>
                    </li>
            </ul>
        </div>
    </nav>  
    <div class='tab-content'>
    <!--************************************************tab 01*****************************************************-->
        <div class="tab-pane content-wrapper py-3 active" id='tab-01'>
            <div class="container-fluid" id='container'>

                <!-- Example Tables Card -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Institutes
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="institutes_table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Institutes</th>
                                        <th>Courses</th>
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
                    <div><p id='info_institute' class='text-center'</p></div>
                </div>
                <div><button class='btn btn-info pull-right' onclick='new_institute1()'>New Institute</button></div>
                </div>
                
                <div class="modal fade" id="courses1" role="dialog" data-backdrop='static'>
                    <div class="modal-dialog modal-lg">
                         <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" onclick='load_institutes()' data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Courses</h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="institutes_courses" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Courses</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody >
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Courses</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        <div><button class='btn btn-info pull-right mt-2' onclick='add_course_button1()'>Add Course</button></div>
                        </div>
                            </div>
                            <div><p id='info_courses' class='text-center'></p></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning"  onclick='save_courses1()'>Save changes</button>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        <!--*****************************************tab  02************************************************-->
        <div class="tab-pane content-wrapper py-3" id='tab-02'>
            <div class="container-fluid" id='container'>
                <!-- Example Tables Card -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Courses
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="courses_table2" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Courses</th>
                                        <th>Subjects</th>
                                    </tr>
                                </thead>
                                <tbody id='institutes_entry'>
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
                    <div><p id='info_courses2' class='text-center'</p></div>
                </div>
                <div><button class='btn btn-info pull-right' onclick='new_course2()'>New Course</button></div>
            </div> 

                <div class="modal fade" id="subjects2" role="dialog" data-backdrop='static'>
                    <div class="modal-dialog modal-lg">
                         <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" onclick='fill_courses2()' data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Subjects</h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="subjects_table2" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Subject</th>
                                        <th>Semester</th>
                                        <th>Passing Internal Practical</th>
                                        <th>Maximum Internal Practical</th>
                                        <th>Passing Internal Theory</th>
                                        <th>Maximum Internal Theory</th>
                                        <th>Passing External Practical</th>
                                        <th>Maximum Enternal Practical</th>
                                        <th>Passing External Theory</th>
                                        <th>Maximum External Theory</th>
                                        <th>Optional</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody >
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Code</th>
                                        <th>Subject</th>
                                        <th>Semester</th>
                                        <th>Passing Internal Practical</th>
                                        <th>Maximum Internal Practical</th>
                                        <th>Passing Internal Theory</th>
                                        <th>Maximum Internal Theory</th>
                                        <th>Passing External Practical</th>
                                        <th>Maximum Enternal Practical</th>
                                        <th>Passing External Theory</th>
                                        <th>Maximum External Theory</th>
                                        <th>Optional</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                            </div>
                            <div><button class='btn btn-info pull-right mt-2' onclick='new_subject2()'>Add Subject</button></div>
                        </div>
                            <div><p id='info_subjects2' class='text-center'></p></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning"  onclick='save_subjects2()'>Save changes</button>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>

        <!--**********************************************tab ends**********************************************-->
        <div class="tab-pane content-wrapper py-3 " id='tab-03'>
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
                        Course:<select id='course' class='mb-3'>
                            <option value='all'>All</option>
                            <option value='CS'>Computer Science</option>
                        </select>
                        Institute:<select id='batch' class='mb-3'>
                            <option value='all'>All</option>
                            <option value='2015'>Aryabhatt Institute of Technology</option>
                        </select>
                        <button onclick='subjects_select()' value='Show' class='mb-3'>Show</button>
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="exam1" cellspacing="0">
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
                                <tbody id='subjects_admin'>
                                    <tr>
                                        <td>CS01</th>
                                        <td>Aryabhatt Institute of Technology</td>
                                        <td>Computer Science</th>
                                        <td>N</th>
                                        <td>N</th>
                                        <td>N</th>
                                    </tr>
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
        </div>
        <!--tab ends-->
        <div class="tab-pane content-wrapper py-3" id='tab-04'>
            <div class="container-fluid" id='container'>

                <!-- Example Tables Card -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Session
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="courses_table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Semester</th>
                                        <th>Year</th>
                                        <th>Session</th>
                                    </tr>
                                </thead>
                                <tbody id='institutes_entry'>
                                <tr>
                                    <td>1</td>
                                    <td>2017</td>
                                    <td>Registration</td>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Semester</th>
                                        <th>Year</th>
                                        <th>Session</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div><button class='btn btn-info pull-right' onclick='newcourse()'>Next Session</button></div>
                </div>   
            </div>
        <!--tab ends-->
        <div class="tab-pane content-wrapper py-3 " id='tab-05'>
            <div id='two'>
                <p id='new'>Not Active</p>
            </div>

        </div>
        <!--tab ends-->
        
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>

HTML;
}   
?>
