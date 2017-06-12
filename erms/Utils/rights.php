<?php
/* 
User Rights Module
Examination Management System 0.1
Utility functions
*/
namespace data\utils\rights;
function check_access($email)
{
	$arguments=[$email];
	$res=\data\utils\database\find('SELECT access from user where email=?',$arguments,1);
	if($res!==-1 and count($res)>0)
	{
		return $res[0]['access'];
	}
	else
		return -1;
}
function addrights($email,$courses)
{
	for($i=0;$i<count($courses);$i++)
	{
		$arguments=[$email,$courses[$i]];
		if(\data\utils\database\insert('INSERT into suballoc(email,course) VALUES(?,?)',$arguments)==1)
		{

		}
		else
			return -1;
	}
	return 1;
	
}
function revokerights($email,$courses)
{
	for($i=0;$i<count($courses);$i++)
	{
		$arguments=[$email,$courses[$i]];
		if(\data\utils\database\delete('DELETE from suballoc email=? and course=?',$arguments)==1)
		{

		}
		else
			return -1;
	}
	return 1;
	
}
function checksubjects($email)
{
	$arguments=[$email];
	$res=\utils\database\find('SELECT course from suballoc where email=?',$arguments,2);
	if(count($res)>0)
	{
		return $res;
	}
	else
	{
		return -1;
	}

}
function checkEmail($email)
{
	$arguments=[$email];
	$res=\data\utils\database\find('SELECT * from premail where email=?',$arguments,2);
	if(count($res)>0)
	{
		return $res['access'];
	}
	else
	{
		return -1;
	}
}
function enter_premail($email,$access)
{
	$arguments=[$email,$access];
	return (\data\utils\database\insert('INSERT into premail(email,access) values(?,?)',$arguments,2));
}

function check_token_verify($token)
{
	$arguments=[$email];
	$res=\data\utils\database\find('SELECT email,access from premail where token=?',$arguments,2);
	return $res;
}