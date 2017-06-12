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
		}
	}
	
}
?>