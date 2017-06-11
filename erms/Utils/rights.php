<?php
/* 
User Rights Module
Examination Management System 0.1
Utility functions
*/
namespace rights;
function check_rights($email)
{
	
}
function addrights()
{
	
}
function revokerights()
{
	
}
function checksubjects()
{
	$arguments=[$email,$year];
	$res=\utils\database\find('SELECT course from suballoc where email=? and year=?',$arguments,2);
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