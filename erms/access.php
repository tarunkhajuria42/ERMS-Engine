<?php
/* ERMS
tarunkhajuria42@gmail.com
*/
namespace data;
function access($email)
{
	if(isset($_POST['request']))
	{
		if(isset($_POST['data']))
		{
			$data=json_decode($_POST['data'],true);
		}
		switch($_POST['request'])
		{
			case 'type':
							$access=utils\rights\check_access($email);
							if($access!=-1)
							{
								$reply['type']=$access;
								$reply['email']=$email;
								echo(utils\reply('access','success',$reply));
							}		
							else
								echo(utils\reply('access','error','noaccess'));
							break;
			case 'get_institute':
							$access=utils\rights\check_access($email);
							if($access!=-1)
							{
								$res=utils\rights\get_institute($email,$access);
								if($res!=-1)
									echo(utils\reply('get_institute','success',$res));
								else
									echo(utils\reply('get_institute','error','system'));
							}
							else
								echo(utils\reply('get_institute','error','no_access'));
							break;
			case 'get_courses':
							$access=utils\rights\check_access($email);
							if($access!=1)
							{
								$res=utils\rights\check_courses($email);
								if($res!=-1)
									echo(utils\reply('get_courses','success',$res));	
								else
									echo(utils\reply('get_courses','error','system'));	
							}
							else
								echo(utils\reply('get_courses','error','no_access'));
							break;
			case 'add_user':
							$email=$data['email'];
							$institute=$data['institute'];
							$course=$data['course'];
							$reply=utils\rights\add_users($email,$institute,$course);
							if($reply!=-1)
								echo(utils\reply('add_users','success','users_added'));
							else
								echo(utils\reply('add_users','error','system'));
							break;
			case 'get_users':
							$institute=$data['institute'];
							$course=$data['course'];
							$reply=utils\rights\get_users($institute,$course);
							if($reply!=-1)
								echo(utils\reply('get_users','success',$reply));
							else
								echo(utils\reply('get_users','error','system'));
							break;
			case 'remove_users':
							$email=$data['email'];
							$course=$data['course'];
							$reply=utils\rights\remove_users($email,$course);
							if($reply!=-1)
								echo(utils\reply('add_users','success','user_removed'));
							else
								echo(utils\reply('add_users','error','system'));
							break;
			default:
					echo(utils\reply('access','error','unknown'));


		}
	}
	
}
?>