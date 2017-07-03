<?php
/* ERMS
tarunkhajuria42@gmail.com
*/
namespace data;
function access($email)
{
	if(isset($_POST['request']))
	{
		switch($_POST['request'])
		{
			case 'type':
							$access=utils\rights\check_access($email);
							if($access!=-1)
							{
								echo(utils\reply('access','success',$access));
							}
							else
							{
								echo(utils\reply('access','error','noaccess'));
							}
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

		}
	}
	
}
?>