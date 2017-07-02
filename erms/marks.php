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
			$data=json_decode($_POST['data'],true);
		}
		switch($_POST['request'])
		{
			case 'get_marks':
							$institute=$data['institute'];
							$subject=$data['subject'];
							$res=utils\marks\get_marks($subject,$institute,$type);
							if($res!=-1)
							{
								echo(utils\reply('get_marks','success',$res));
							}	
							break;
			case 'get_subjects':
							$institute=$data['institute'];
							$course=$data['course'];
							if(utils\marks\find_subjects($course,$institute)!=-1)
							{
								$batches=utils\marks\find_subjects($course,$institute);
								echo(utils\reply('subjects','success',$batches));	
							}
							break;
			case 'add_marks':$res=utils\marks\add_marks($data);
								if($res!=-1)
									echo(utils\reply('add_marks','success','marks_added'));
								else
									echo(utils\reply('add_marks','error','failed'));
								break;
			case 'edit_marks':$res= utils\marks\edit_marks($data);
								if($res!=-1)
									echo(utils\reply('edit_marks','success','edited'));
								else
									echo(utils\reply('edit_marks','error','edit_failed'));
								break;
			default:
					echo(utils\reply('marks','error','badrequest'));	

		}	
	}
	else
	{
		echo(utils\reply('marks','error','badrequest'));
	}
	
}
