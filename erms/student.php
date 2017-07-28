<?php 
/* 
Scalable Data Management System
Educational Institutions
----------------------------------------------------
Version 0.1 
Author: Tarun Khajuria (tarunkhajuria42@gmail.com)
----------------------------------------------------
Utils: User Access
*/	

namespace data;
require('utils/student.php');
require('utils/admit.php');

function student($user)
{
	if(isset($_POST['request']))
	{
		if(isset($_POST['data']))
		{
			$data=json_decode($_POST['data'],true);
		}
		switch($_POST['request'])
		{
			case 'screen_status':$res=utils\student\get_screen($user);
								if($res!=-1)
									echo(utils\reply('student','success',$res));
								else
									echo(utils\reply('student','error','system'));
								break;
			case 'exam_form':	$res=utils\admit\exam_form($user);
								if($res!=-1)
									echo(utils\reply('student','success',$res));
								else
									echo(utils\reply('student','error','system'));
								break;
			case 'admit_card':	$res=utils\admit\admit_details($user);
								if($res!=-1)
									echo(utils\reply('admit_card','success',$res));
								else
									echo(utils\reply('admit_card','error','system'));
								break;	
			case 'marksheet':	$res=utils\admit\get_marksheet();
								if($res!=-1)
									echo(utils\reply('admit_card','success',$res));
								else
									echo(utils\reply('admit_card','error','system'));
								break;	
			case 'add_student':if($res!=-1)
									echo(utils\reply('admit_card','success',$res));
								else
									echo(utils\reply('admit_card','error','system'));
								break;	
			case 'get_student':if($res!=-1)
									echo(utils\reply('get_student','success',$res));
								else
									echo(utils\reply('get_student','error','system'));
								break;
			case 'edit_student':if($res!=-1)
									echo(utils\reply('get_student','success',$res));
								else
									echo(utils\reply('get_student','error','system'));
								break;
			case 'delete_student':
								if($res!=-1)
									echo(utils\reply('get_student','success',$res));
								else
									echo(utils\reply('get_student','error','system'));
								break;
			default:	echo(utils\reply('student','error','badrequest'));	

		}	
	}
	else
	{
		echo(utils\reply('user','error','badrequest'));
	}
	
}
?>
