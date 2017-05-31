<?php
/* 
Exam Management System

Version 0.1
Author: Tarun Khajuria(tarunkhajuria@gmail.com)

Model Entry point
*/
namespace data;
require('Utils/database.php');	
require('user.php');
require('marks.php');
require('access.php');
$name=["abc"];
echo(json_encode(util\database\find('Select userid from login where token=?',$name)));
/*
if(isset($_COOKIE['user']))
{
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
else{
	if(isset($_POST['type']))
	{
		switch($_POST['type'])
		{
			case 'user': echo("badiya");
			default : 
		}
	}
	else
	{
		echo(json_encode(utils\error(2)));
	}
	
	
}
*/





