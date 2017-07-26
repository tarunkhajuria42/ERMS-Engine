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
require('lists.php');
require('session.php');
require('student.php');
require('Utils/session.php');
require('Utils/marks.php');
require('Utils/reply.php');
require('Utils/access.php');
require('Utils/database.php');
require('Utils/rights.php');
require('Utils/course.php');

//utils\user\register('deepankar@imfundo.io','deepankar','deepankar',5);
//utils\user\newSession('tarun@imfundo.io');
//die();
$res=utils\user\checkSession();
if($res<0)
{
	if(isset($_POST['type']))
	{
		if($_POST['type']=='user')
			user();
		else{
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
			case 'access':access($res[0]['email']);
						break;
			case 'session':session($res[0]['email']);
						break;
			case 'lists':lists();
						break;
			case 'student':student($res[0]['email']);
						break;
			case 'access':student($res[0]['email']);
						break;
			default:
				echo(utils\reply('type','error','badrequest'));	
		}	
	}
	else
	{
		echo(utils\reply('type','error','norequest'));
	}
}