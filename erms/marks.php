<?php
/* 
Scalable Data Management System
Educational Institutions
----------------------------------------------------
Version 0.1 
Author: Tarun Khajuria (tarunkhajuria42@gmail.com)
----------------------------------------------------
Marks Management
*/
namespace data;
function marks(){
	if(isset($_POST['request']))
	{
		if(isset($_POST['data']))
		{
			$data=json_decode($_POST['data']);
		}
		switch($_POST['request'])
		{
			case 'get_marks':

							break;
			case 'get_subjects':
							$institute=$data['institute'];
							$course=$data['course'];
							if(utils\marks\find_subjects($course,$institute)!=-1)
							{
								
							}
							break;
			case 'add_marks':
			case 'edit_marks':
			default:
					echo(utils\reply('marks','error','badrequest'));	

		}	
	}
	else
	{
		echo(utils\reply('marks','error','badrequest'));
	}
	
}
