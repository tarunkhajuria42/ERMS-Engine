<?php
namespace data;

function session()
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
							if(utils\marks\next_session()==1)
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
							$res=utils\marks\get_session();
							if(count($res)>0)
							{
								echo(utils\reply('session','success',json_encode($res)));	
							}
							else
							{
								echo(utils\reply('session','error','system'));
							}
							break;
			case default:
						echo(utils\reply('session','error','badrequest'));

		}	
	}
	else
	{
		echo(utils\reply('session','error','badrequest'));
	}
	
}
?>