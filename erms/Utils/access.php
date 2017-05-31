<?php
/*
Examination Management

Version 0.1
Author: Tarun Khajuria (tarunkhajuria42@gmail.com)

Utils for Password Management
*/
namespace data\util\user;
require(database.php);
//Generates Acess token for a session
function generate_token(username)
{
	$token=bin2hex(random_bytes(16));
	if(utils::insert($token,$username)==1)
		return $token;
	else 
		return -1;
}
function store_password($username,$password)
{
	
}
function check_password($username,$password)
{

}
function change_password($username,$password,$newpassword){

}
function checkEmail($email)
{

}

?>
