<?php
/* 
Exam Management System

Version 0.1
Author: Tarun Khajuria(tarunkhajuria@gmail.com)

Model Entry point
*/
namespace data;
require('user.php');
require('marks.php');
require('access.php');
require('Utils/session.php');
require('Utils/reply.php');


$res=util\user\checkSession();

if($res<0)
{
	isset($_POST['type']=='user')
	{
		data\user();
	}
	else
	{
		if(res==-3)
		{
			echo(utils\reply('session','error','timeout'));
		}
		else
		{
			echo(utils\reply('session','error','invalid');
		}
		
	}
}
else{
	if(isset($_post['type']))
	{
		switch($_POST['type'])
		{
			case 'user': data\user();
						break;
			case 'marks':data\marks();
						break;
			case 'access':data\access();
						break;
			default:
				echo(json_encode(utils\reply('request','error','badrequest')));	
		}	
	}
}