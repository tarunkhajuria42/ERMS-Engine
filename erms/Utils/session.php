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
namespace data\util\user;

function new_session()
{
	
}
function destroy_session()
{

}
/* returns the userid if session is set else returns -1*/
function check_session()
{
	if(isset($_COOKIE['token']))
	{
		$selector=..\database\find('Select userid from login where token =?',$_COOKIE['token']);
			
	}
	else 
	return -1;
	
	
}
