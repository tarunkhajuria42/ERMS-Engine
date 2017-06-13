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
    <!--tab 01-->
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

                </div>
                <div><button class='btn btn-info pull-right' onclick='newinstitute()'>New Institute</button></div>
                </div>
                
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-lg">
                         <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Courses</h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="institutes_courses" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Courses</th>
                                    </tr>
                                </thead>
                                <tbody id='institutes_entry'>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Courses</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" onclick='submit_courses1()'>Close</button>
                            </div>
                        </div>   
                    </div>
                </div>
                <div class="modal fade" id="myModal2" role="dialog">
                    <div class="modal-dialog modal-lg">
                         <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Courses</h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="institutes_courses" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Courses</th>
                                    </tr>
                                </thead>
                                <tbody id='institutes_entry'>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Courses</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" onclick='new_submit_courses1()'>Close</button>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        <!--tab ends-->
        <div class="tab-pane content-wrapper py-3" id='tab-02'>
            <div class="container-fluid" id='container'>

                <!-- Example Tables Card -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Courses
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="courses_table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Courses</th>
                                        <th>Subjects</th>
                                    </tr>
                                </thead>
                                <tbody id='institutes_entry'>
                                <tr>
                                    <td>Computer Science</td>
                                    <td><button class='btn btn-info pull-right'>Add/Edit</button></td>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Courses</th>
                                        <th>Subjects</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div><button class='btn btn-info pull-right' onclick='newcourse()'>New Course</button></div>
                </div>   
            </div>
        <!--tab ends-->
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
                                        <th>Course</th>
                                        <th>Batch</th>
                                        <th>Internal Practical</th>
                                        <th>Internal Theory</th>
                                        <th>External Practical</th>
                                    </tr>
                                </thead>
                                <tbody id='subjects_admin'>
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
                </div>
        </div>
        <!--tab ends-->
        <div class="tab-pane content-wrapper py-3 " id='tab-04'>
            <div id='two'>
                <p id='new'>Not Active</p>
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
