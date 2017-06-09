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
		switch($_POST['request'])
		{
			case 'login': $data=json_decode($_POST['data']);
							if(\data\utils\user\login($data['email'],$data['password'])==1)
								echo(utils\reply('user','success','login'));
							else
								echo(utisl\reply('user','error','badpassword'));

			case 'register':$data=json_decode($_POST['data']);
							if()
			case 'cpass':
			case 'forgetp':
			case 'default':	echo(json_encode(utils\error(0)));	

		}	
	}
	else
	{
		echo(utils\error(0));
	}
	
}
?>
