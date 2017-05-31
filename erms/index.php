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
$parameters=['abc'];

utils\user\newSession("usrsds");

/*
$res=util\user\checkSession();

if($res <0)
{
	echo(utils\error(abs($res)));
	
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
				echo(json_encode(utils\error(0)));	
		}	
	}
}


*/