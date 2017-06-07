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
require('Utils/error.php');

function user()
{
	if(isset($_POST['request']))
	{
		switch($_POST['request'])
		{
			case 'login':
			case 'register':
			case 'cpass':
			case 'forgetp':
		}	
	}
	else
	{
		echo(utils\error(0));
	}
	
}
?>
