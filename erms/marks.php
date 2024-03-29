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
							$max=utils\marks\get_max($subject,$type);
							if($res!=-1 && $max!=-1)
							{
								$reply['marks']=$res;
								$reply['max']=$max;
								echo(utils\reply('get_marks','success',$reply));
							}	
							else
								echo(utils\reply('get_marks','error','system'));
							break;
			case 'get_subjects':
							$institute=$data['institute'];
							$course=$data['course'];
							$semester=$data['semester'];
							$batches=utils\marks\find_subjects($course,$institute,$semester);
							if($batches!=-1)
								echo(utils\reply('subjects','success',$batches));	
							else
								echo(utils\reply('subjects','error','system'));
							break;
			case 'add_marks_external':
							$res=utils\marks\check_data($data);
							if($res!=-1)
							{
								$res=utils\marks\add_marks($data);
								if($res!=-1)
									echo(utils\reply('add_marks','success','marks_added'));
								else
									echo(utils\reply('add_marks','error','failed'));
							}
							else
								echo(utils\reply('add_marks','message','Invalid Data'));
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
			case 'submit_marks': $res=utils\marks\submit_marks($data);
								if($res!=-1)
									echo(utils\reply('submit_marks','success','marks_submitted'));
								else
									echo(utils\reply('submit_marks','error','failed'));
								break;
			case 'get_students':
							$institute=$data['institute'];
							$subject=$data['subject'];
							$type=$data['type'];
							$max=utils\marks\get_max($subject,$type);
							$res=utils\marks\get_students($subject,$institute,$type);
							if($res!=-1 && $max!=-1)
							{
								$reply['max']=$max;
								$reply['student']=$res;
								echo(utils\reply('get_marks','success',$reply));	
							}
							else
								echo(utils\reply('get_marks','error','system'));
							break;
			case 'get_datesheet':
							$course=$data['course'];
							$semester=$data['semester'];
							$res=utils\marks\get_datesheet($course,$semester);
							if($res!=-1)
								echo(utils\reply('marksheet','success',$res));
							else
								echo(utils\reply('marksheet','error','system'));
							break;
			case 'add_datesheet':
							$res=utils\marks\add_datesheet($data);
							if($res!=-1)
								echo(utils\reply('marksheet','success',$res));
							else
								echo(utils\reply('marksheet','error','system'));
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
