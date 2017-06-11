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
require('Utils/marks.php');
require('Utils/reply.php');
require('Utils/access.php');
require('Utils/database.php');


echo(utils\marks\new_session('tarun'));
die();
if($res<0)
{
	if(isset($_POST['type']))
	{
		if($_POST['type']=='user')
			user();
	}
	else
	{
		if($res==-3)
		{
			echo(utils\reply('session','error','timeout'));
		}
		else
		{
			echo(utils\reply('session','error','invalid'));
		}
		
	}
}
else{
	if(isset($_POST['type']))
	{
		switch($_POST['type'])
		{
			case 'user': user();
						break;
			case 'marks':marks();
						break;
			case 'access':access();
						break;
			case 'session':session();
						break;
			default:
				echo(json_encode(utils\reply('request','error','badrequest')));	
		}	
	}
}