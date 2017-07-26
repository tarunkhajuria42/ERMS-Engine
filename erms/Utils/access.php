<?php
/*
Examination Management

Version 0.1
Author: Tarun Khajuria (tarunkhajuria42@gmail.com)

Utils for Password Management
*/
namespace data\utils\user;
//Hash the password
function hash_password($password)
{
	$options = [
    'cost' => 11,
    'salt' => \mcrypt_create_iv(22, \MCRYPT_DEV_URANDOM),
	];
	try
	{
		return(\password_hash($password,\PASSWORD_BCRYPT,$options));
	}
	catch(\Exception $e)
	{
		return -1;
	}
}

//Register 
function register($email,$password,$name,$access)
{
	$pass=hash_password($password);
	$arguments=[$email,$pass,$name,$access];
	if(\data\utils\database\insert('INSERT into user(email,password,name,access) values(?,?,?,?)',$arguments,1)==1)
		{
			return 1;
		}
		else
		{
			return -1;
		}
}

function check_password($email,$password)
{
	$arguments=[$email];
	$result=\data\utils\database\find('SELECT password FROM user WHERE email=?',$arguments,1);
	if(count($result)>0)
	{
		if(password_verify($password,$result[0]['password']))
		{
			return 1;
		}
		else
		{
			return -1;
		}

	}
	else{
		return -1;
	}
}
function login($email,$password)
{
	if(check_password($email,$password)==1)
	{
		if(newSession($email)==1)
			return 1;	
		else
			return -1;
	}
	else
		return -1;
}

function change_password($email,$password){
	$pass=hash_password($password);
	$arguments=[$pass,$email];
	if(\data\utils\database\update('UPDATE user SET password=? where email=?',$arguments,1)==1)
		return 1;
	else
		return -1;

}

function email_token($email)
{
	$token=\bin2hex(\random_bytes(16));
	$arguments=[$token,$email];
	if(\data\utils\database\insert('UPDATE premail SET token=? where email=?',$arguments,2)==1)
	{
		if(\data\utils\email\sendmail($email,$token)==1)
			return 1;
		else 
			return -1;
	}
	else
	{
		return -1;
	}
	//Send email;
}
function email_verify($token)
{
	$user=\data\utils\database\find('SELECT * from premail where token=?',[$token],2);
	if($user==-1)
		return -1;
	if(count($user)>0)
	{
		
		//Activate user record
		//Remove premail entry
	}
	else
		return -2;
}
function passwordEmail($email)
{

}
?>
