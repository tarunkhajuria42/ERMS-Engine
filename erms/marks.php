<?php
/* 
Scalable Data Management System
Educational Institutions
----------------------------------------------------
Version 0.1 
Author: Tarun Khajuria (tarunkhajuria42@gmail.com)
----------------------------------------------------
User management Pages
*/
namespace data;
function marks(){
	if(isset($_POST['request']))
	{
		if(isset($_POST['data']))
		{
			$data=json_decode($_POST['data']);
		}
		switch($_POST['request'])
		{
			case 'get_marks':
							break;
			default:

		}	
	}
	else
	{
		echo(utils\reply('marks','error','badrequest'));
	}
	
}
