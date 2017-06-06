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
namespace data\utils\user;
require("database.php");

//Generates Acess token for a session

function newSession($uid)
{
	define('valid_time',10);
	
	$i=0;
	do
	{
		$token= \bin2hex(\random_bytes(16));
		$valid=\date('Y-m-d H:i:s',time()+(valid_time*60));
		$arguments=[$uid,$token,$valid];
		$res=\data\utils\database\insert('INSERT into login(userid,token,valid) VALUES(?,?,?)',$arguments,2);
		if($res==1)
		{
			setcookie('user',$token,$valid,secure=TRUE)
			return 1;
		}
		elseif($res!=='23000')
		{
			return -1;
		}
		$i++;
	}while($i<10);
	return -1;
}


function destroySession()
{
	if(isset($_COOKIE['token']))
	{
		$arguments=[$_COOKIE['token']];
		if(\database\delete('DELETE from login where token=?',$arguments)==-1)
		{
			return -1;
		}
		else
		{
			return 1;
		}
		
	}
}
/* returns the userid if session is set else generates -ve of specific errors
See utils/error()
*/
function checkSession()
{
	if(isset($_COOKIE['token']))	
	{
		$arguments=[$_COOKIE['token']];
		$results=\database\find('SELECT userid,valid FROM login WHERE token =?',$arguments);
		if(count($result)>0)
		{
			if (time<$result[0]['valid'])
				return $result;
			else
				destroySession();
				return -3;
		}
		else
		{
			return -2;
		}

	}
	else 
		return -1;
}
