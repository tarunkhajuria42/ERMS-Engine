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
							if(utils\user\login($data['email'],$data['password'])==1)
								echo(utils\reply('user','success','login'));
							else
								echo(utils\reply('user','error','badpassword'));
							break; 

			case 'register':
							$res=\utils\rights\check_token_verify($_GET['token']);
							if(count($res)>0)
							{

								if(utils\user\register($res[0]['email'],$data['password'],$data['name'],$res[0]['access'])==1)
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
			case 'verify_email':
							$access=\utils\rights\check_email($data['email']);
							if($access!=-1)
							{
								if(utils\user\email_verify(data['email'])==1)
									echo(utils\reply('user','success','emailsent'));
								else
									echo(utils\reply('user','error','emailnotsent'));
							}
							else
								echo(utils\reply('user','error','notregistered'));
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
							if(utils\user\email_password($data['email'])==1)
								echo(utils\reply('user','success','passwordemailed'));
							else
								echo(utils\reply('user','error','wrongemail'));
							break;
			case 'enterpassword':
								if(utils\user\change_password($data['email'],$data['newpassword'])==1)
									echo(utils\reply('user','success','changepassword'));
								else
									echo(utils\reply('user','error','systemerror'));
								break;
			default:	echo(utils\reply('user','error','badrequest'));	

		}	
	}
	else
	{
		echo(utils\reply('user','error','badrequest'));
	}
	
}
?>
