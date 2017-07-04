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

function student()
{
	if(isset($_POST['request']))
	{
		if(isset($_POST['data']))
		{
			$data=json_decode($_POST['data'],true);
		}
		switch($_POST['request'])
		{
			case 'get_papers':
			case 'get_semester':
			case
			
			default:	echo(utils\reply('user','error','badrequest'));	

		}	
	}
	else
	{
		echo(utils\reply('user','error','badrequest'));
	}
	
}
?>
