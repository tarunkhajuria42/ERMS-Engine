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
require('Utils/reply.php');

function user()
{
	if(isset($_POST['request']))
	{
		if(isset($_POST['data']))
		{
			$data=json_decode($_POST['data']);
		}
		switch($_POST['request'])
		{
			case 'login': 
							if(\data\utils\user\login($data['email'],$data['password'])==1)
								echo(utils\reply('user','success','login'));
							else
								echo(utils\reply('user','error','badpassword'));
							break;

			case 'register':
							$access=\utils\rights\check_email($data['email']);
							if($access !==-1)
							{
								if(utils\user\register($data['email'],$data['password'],$data['name'],$access))==1)
								{
									echo(utils\reply('user','success','register'));
								}
								else
								{
									echo(utils\reply('user','error','notregistered'));
								}
							}
							else{
								echo(utils\reply('user','error','unregistered'));
							}
							break;
			case 'cpass':
							
							if(utils\user\check_password($data['email'],$data['password'])==1)
								{
								if(utils\user\change_password($data['email'],$data['newpassword'])==1)
									echo(utils\reply('user','success','changepassword'));
								else
									echo(utils\reply('user','error','systemerror'));
								}
							else
								echo(utils\reply('user','error','wrongpassword'));
							break;

			case 'emailpassword':
			case 'enterpassword':
								if(utils\user\change_password($data['email'],$data['newpassword'])==1)
									echo(utils\reply('user','success','changepassword'));
								else
									echo(utils\reply('user','error','systemerror'));
								}
								break;

							



			case 'default':	echo(utils\reply('user','error','badrequest');	

		}	
	}
	else
	{
		echo(utils\error(0));
	}
	
}
?>
