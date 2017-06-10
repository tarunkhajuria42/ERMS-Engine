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

function newSession($email)
{
	define('valid_time',10);
	
	$i=0;
	do
	{
		$token= \bin2hex(\random_bytes(16));
		$validTill=time()+(valid_time*60);
		$valid=timeZone($validTill);
		$arguments=[$email,$token,$valid];
		$res=\data\utils\database\insert('INSERT into login(email,token,valid) VALUES(?,?,?)',$arguments,2);
		if($res==1)
		{
			setcookie('token',$token,$validTill);
			return 1;
		}
		elseif($res!=='23000')
		{
			return -1;
		}
		$i++;
	}while($i<1);
	return -1;
}


function destroySession()
{
	if(isset($_COOKIE['token']))
	{
		$arguments=[$_COOKIE['token']];
		setcookie('token');
		if(\data\utils\database\delete('DELETE from login where token=?',$arguments)==-1)
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
		echo $_COOKIE['token'];
		$arguments=[$_COOKIE['token']];
		$result=\data\utils\database\find('SELECT email,valid,access FROM login WHERE token =?',$arguments,2);
		if(count($result)>0)
		{
			echo(\time());
			echo($result[0]['valid']);
			if (timeZone(\time())<$result[0]['valid'])
			{
				destroySession();
				newSession($result[0]['email']);
				return $result;
			}
			else
			{
				destroySession();
				return -3;
			}
		}
		else
		{
			return -2;
		}

	}
	else 
		return -1;
}
function timeZone($time)
{
	$tz = 'Asia/Calcutta';
	$dt = new \DateTime("now", new \DateTimeZone($tz)); //first argument "must" be a string
	$dt->setTimestamp($time); //adjust the object to correct timestamp
	return ($dt->format('Y-m-d H:i:s'));	
}
