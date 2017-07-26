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
	$res=\data\utils\database\find('SELECT course from suballoc where email=?',$arguments,2);
	if($res!=1)
	{
		return $res;
	}
	else
	{
		return -1;
	}

}
function check_courses($email)
{
	$arguments=[$email];
	$res=\data\utils\database\find('SELECT course from suballoc where email=?',$arguments,1);
	if($res!=-1)
	{
		$courses=[];
		for($i=0; $i<count($res); $i++)
		{
			array_push($courses,$res[$i]['course']);
		}
		return $courses;
	}
	else
		return -1;
}
function checkEmail($email)
{
	$arguments=[$email];
	$res=\data\utils\database\find('SELECT * from premail where email=?',$arguments,2);
	if(count($res)>0)
		return $res['access'];
	else
		return -1;
}
function enter_premail($email,$access)
{
	$arguments=[$email,$access];
	return (\data\utils\database\insert('INSERT into premail(email,access) values(?,?)',$arguments,2));
}
function get_institute($email,$access)
{
	if($access<3 && $access>0)
	{	
		$arguments=[$email];
		$res=\data\utils\database\find('SELECT institute from staff where email=?',$arguments,1);
		if($res!=-1)
			return $res[0]['institute'];
		else
			return -1;
	}
	else if($access==5)
	{
		$res=\data\utils\database\find('SELECT institute from student where email=?',$arguments,1);
		if($res!=-1)
			return $res[0]['institute'];
		else
			return -1;	
	}
	
}
function add_users($list,$institute,$course)
{
	if($institute=='center')
	{

	}
	else
	{
		if($course=='all')
		{
			for ($i=0; $i<count($list); $i++)
			{	
				//if not already added as user
				$arguments=[$list[$i]['email'],1];
				//add to premail
				$reply=\data\utils\database('INSERT into premail(email,access) values(?,?)',$arguments,2);
				if($reply==-1)
					return -1;
				$arguments[$list[$i]['email'],$institute];
				$reply=\data\utils\database('INSERT into staff(email,institute) values(?,?)',$arguments,1);
				if($reply==-1)
					return -1;
			}	
		}
		else
		{
			for ($i=0; $i<count($list); $i++)
			{	
				$arguments=[$list[$i]['email'],2];
				$reply=\data\utils\database('INSERT into premail(email,access) values(?,?)',$arguments,2);

			}	
		}	
	}
	
	
}
function check_users($institute,$course)
{
	if($institute=='center')
	{
		if($course=='all')
		{
			$users=\data\utils\database\find('SELECT email from premail where access=3 and email in (SELECT email from staff where institute='center')',[],1);
			$users2=\data\utils\database\find('SELECT email from user where access=3 and email in(SELECT email from staff where institute='center')',[],1);
			if($users==-1 || $users2==-1)
				return -1;
			$all_users=[];
			for($i=0; $i<count($users);$i++)
			{
				array_push($all_users,$users[$i]['email']);
			}
			for($i=0; $i<count($users2);$i++)
			{
				array_push($all_users,$users2[$i]['email']);
			}
			return $all_users;
		}
		else
		{
			$users=\data\utils\database\find('SELECT email from premail where access=3 and email in (SELECT email from staff where institute='center')',[$course],1);
			$users2=\data\utils\database\find('SELECT email from user where access=3 and email in(SELECT email from staff where institute='center')',[$course],1);
			if($users==-1 || $users2==-1)
				return -1;
			$all_users=[];
			for($i=0; $i<count($users);$i++)
			{
				array_push($all_users,$users[$i]['email']);
			}
			for($i=0; $i<count($users2);$i++)
			{
				array_push($all_users,$users2[$i]['email']);
			}
			return $all_users;
		}

	}
	else
	{
		if($course=='all')
		{
			$arguments=[$institute];
			$users=\data\utils\database\find('SELECT email from premail where access=1 and email in (SELECT email from staff where institute=?)',$arguments,1);
			$users2=\data\utils\database\find('SELECT email from user where access=1 and email in(SELECT email from staff where institute=?)',$arguments,1);
			if($users==-1 || $users2==-1)
				return -1;
			$all_users=[];
			for($i=0; $i<count($users);$i++)
			{
				array_push($all_users,$users[$i]['email']);
			}
			for($i=0; $i<count($users2);$i++)
			{
				array_push($all_users,$users2[$i]['email']);
			}
			return $all_users;
		}
		else
		{
			$arguments=[$course,$institute];
			$users=\data\utils\database\find('SELECT email from premail where access=2 and email in(SELECT email from suballoc where course=? and email in(SELECT email from staff where institute=?))',$arguments,1);
			$users2=\data\utils\database\find('SELECT email from user where access=2 and email in(SELECT email from suballoc where course=? and email in(SELECT email from staff where institute=?)',$arguments,1);
			if($users==-1 || $users2==-1)
				return -1;
			$all_users=[];
			for($i=0; $i<count($users);$i++)
			{
				array_push($all_users,$users[$i]['email']);
			}
			for($i=0; $i<count($users2);$i++)
			{
				array_push($all_users,$users2[$i]['email']);
			}
			return $all_users;	
		}
		
	}
	
}
function check_token_verify($token)
{
	$arguments=[$email];
	$res=\data\utils\database\find('SELECT email,access from premail where token=?',$arguments,2);
	return $res;
}