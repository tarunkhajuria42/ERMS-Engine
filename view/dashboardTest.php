<?php
/*access level 
0: admin
1: college admins
2: college entry
3: exam admins
4: exam entry
5: student
*/
namespace view;
require('dashboard/teacher.php');
require('dashboard/principal.php');
require('dashboard/teacher.php');
require('dashboard/examAdmin.php');
require('dashboard/examEntry.php');
require('dashboard/student.php');

if($_POST['access']==0)
{
	echo(\view\teacher());
}
else if($_POST['access']==1)
{
	echo(\view\principal());
}
else if($_POST['access']==2)
{
	echo(\view\teacher());
}
else if($_POST['access']==3)
{
	echo(\view\examAdmin());
}else if($_POST['access']==4)
{
	echo(\view\examEntry());
}
else if($_POST['access']==5)
{
	echo(\view\student());
}
?>