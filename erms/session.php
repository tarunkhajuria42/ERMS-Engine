<?php
namespace data;

function session($email)
{
if(isset($_POST['request']))
	{
		if(isset($_POST['data']))
		{
			$data=json_decode($_POST['data'],true);
		}
		switch($_POST['request'])
		{
			case 'next_session':

							if(utils\marks\new_session($email)==1)
							{
								echo(utils\reply('session','success','newsession'));
							}
							else
							{
								echo(utils\reply('session','error','system'));
							}
							break;	
			case 'prev_session':
							if(utils\marks\prev_session()==1)
							{
								echo(utils\reply('session','success','prevsession'));
							}
							else
							{
								echo(utils\reply('session','error','system'));
							}
							break;
			case 'get_session':
							$res=utils\marks\check_session();
							if($res!=-1)
							{
								echo(utils\reply('session','success',$res));	
							}
							else
							{
								echo(utils\reply('session','error','system'));
							}
							break;
			default:
						echo(utils\reply('session','error','badrequest'));

		}	
	}
	else
	{
		echo(utils\reply('session','error','badrequest'));
	}
	
}
?>