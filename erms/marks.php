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
							$type=$data['type'];
							$res=utils\marks\get_marks($subject,$institute,$type);
							if($res!=-1)
							{
								echo(utils\reply('get_marks','success',$res));
							}	
							else
								echo(utils\reply('get_marks','error','system'));
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
			case 'get_students':
							$institute=$data['institute'];
							$subject=$data['subject'];
							$type=$data['type'];
							$res=utils\marks\get_students($subject,$institute,$type);
							if($res!=-1)
								echo(utils\reply('get_marks','success',$res));	
							else
								echo(utils\reply('get_marks','error','system'));
							break;
			case 'get_marksheet':
							$course=$data['course'];
							$res=utils\marks\get_marksheet($course);
							if($res!=-1)
								echo(utils\reply('marksheet','success',$res));
							else
								echo(utils\reply('marksheet','error','system'));
							break;
			case 'marksheet_data':
							$list=$data['cour']

			default:
					echo(utils\reply('marks','error','badrequest'));	

		}	
	}
	else
	{
		echo(utils\reply('marks','error','badrequest'));
	}
	
}
