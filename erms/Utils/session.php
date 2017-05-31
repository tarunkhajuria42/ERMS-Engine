<?php
/* 
Scalable Data Management System
Educational Institutions
----------------------------------------------------
Version 0.1 
Author: Tarun Khajuria (tarunkhajuria42@gmail.com)
----------------------------------------------------
Session maintainace functions
*/
require(database.php);
namespace data\utils\user;

function newSession()
{
	
}
function destroySession()
{

}
/* returns the userid if session is set else returns -1*/
function checkSession()
{
	if(isset($_COOKIE['token']))	
	{
		$arguments=[$_COOKIE['token']];
		$results=..\database\find('SELECT userid,valid FROM login WHERE token =?',$arguments);
		if(count($result)>0)
		{
			if (time<$result[0]['valid'])
				return $result;
			else
				destroySession()
				return -3
		}
		else
		{
			return -2;
		}

	}
	else 
		return -1;
}
