<?php
$code=<<<html
    <!-- Navigation -->
    <div id='welcome'>
        <p class='welcome'>Welcome Tarun</p>
    </div>
    <nav id="mainNav" class="navbar static-top navbar-toggleable-md navbar-inverse">
        <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
        echo(misc\header());
        ?>
        <div class="collapse navbar-collapse" id="navbarmain">  
            <ul class="sidebar-nav navbar-nav nav-tabs" id='navlist'>
         			<li class="nav-item active">
                    	<a class="nav-link" href="#tab-01" aria-controls="tab-01" role="tab" data-toggle="tab">Marks</a>
                	</li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-02" aria-controls="tab-02" role="tab" data-toggle="tab">Session</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-02" aria-controls="tab-04" role="tab" data-toggle="tab">Manage Courses</a>
                    </li>   	
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-02" aria-controls="tab-05" role="tab" data-toggle="tab">Logout</a>
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
                    <i class="fa fa-table"></i> Checked Marks
                </div>
                <div class="card-block">
                    Course:<select id='course' class='mb-3'>
                        <option value='all'>All</option>
                        <option value='CS'>Computer Science</option>
                        <option value='ECE'>Electronics</option>
                    </select>
                    Batch:<select id='batch' class='mb-3'>
                        <option value='all'>All</option>
                        <option value='2015'>2015</option>
                        <option value='2016'>2016</option>
                    </select>
                    <button onclick='subjects_select()' value='Show' class='mb-3'>Show</button>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" id="dataTable1" cellspacing="0">
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
                            <tbody id='marks_table'>
                                <tr>
                                    <td >11534</td>
                                    <td>Manas Mehta</td>
                                    <td id='e1_11534' class='entry1'><input id='i1_11534' type='text' value='123'></td>
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
                        <button id='submitButton' name='Submit' class='pull-right mr-2' onclick='submit()'>Submit</button>
                </div>
                <div class="card-footer small text-muted">
                    CopyRight Board of Technical Education
                </div>
            </div>
            
        </div>
    <!-- /.content-wrapper -->
    </div>

<!--Tab 02 -->  
    <div class="tab-pane content-wrapper py-3" id='tab-02'>
        <div class="container-fluid" id='container'>

            <!-- Breadcrumbs -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>dat
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
                        <option value='ECE'>Electronics</option>
                    </select>
                    Batch:<select id='batch' class='mb-3'>
                        <option value='all'>All</option>
                        <option value='2015'>2015</option>
                        <option value='2016'>2016</option>
                    </select>
                    <button onclick='subjects_select()' value='Show' class='mb-3'>Show</button>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" id="table2" cellspacing="0">
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
                                <tr>
                                    <td >AA130</td>
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
                        <table class="table table-bordered" width="100%" id="subject_table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Roll No</th>
                                    <th>Name</th>
                                    <th>Entry 1</th>
                                    <th>Entry 2</th>
                                </tr>
                            </thead>
                            <tbody id='marks_table'>
                                <tr>
                                    <td >11534</td>
                                    <td>Manas Mehta</td>
                                    <td id='e1_11534' class='entry1'><input id='i1_11534' type='text' value='123'></td>
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
                        <button id='submitButton' name='Submit' class='pull-right mr-2' onclick='submit()'>Submit</button>
                </div>
                <div class="card-footer small text-muted">
                    CopyRight Board of Technical Education
                </div>
            </div>

           
    </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
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

html;
echo($code);
?>