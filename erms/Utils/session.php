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

//Generates Acess token for a session
define('valid_time',60);
function newSession($email)
{
	
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
		//var_dump($arguments);
		setcookie('token');
		$res=\data\utils\database\delete('DELETE from login where token=?',$arguments,2);
		//var_dump($res);
		return $res;	
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
		$result=\data\utils\database\find('SELECT email,valid FROM login WHERE token =?',$arguments,2);
		//var_dump($result); 
		if(count($result)>0 and $result!==-1)
		{
			if(timeZone(\time())<$result[0]['valid'])
			{
				//echo($result[0]['valid']);
				//echo(timeZone(\time()));
				//echo(strtotime($result[0]['valid'])-strtotime(timeZone(\time())));
				$a=strtotime(timeZone(\time()));
				$b=strtotime($result[0]['valid'])-(60*valid_time)+60;
				//echo($a);
				if(strtotime(timeZone(\time()))>(strtotime($result[0]['valid'])-(60*valid_time)+60))
				{
					//echo('done');
					destroySession();
					newSession($result[0]['email']);	
				}
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

