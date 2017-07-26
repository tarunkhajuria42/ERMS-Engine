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
function check_existing($email)
{
	$premail=\data\utils\database\find('SELECT email from premail where email=?',[$email],1);
	$user=\data\utils\database\find('SELECT email from user where email=?',[$email],1);
	if($premail==-1 && $user==-1)
		return -1
	if(count($premail)>0 || count($user)>0)
		return 1;
	else
		return 0;
}
function add_users($email,$institute,$course)
{
	if($institute=='center')
	{
		if($course=='all')
		{
			if(check_existing($email)==0)
			{
				$status=\data\utils\database\insert('INSERT into premail(email,access) values(?,?)',[$email,3],1);
				if($status==-1)
					return -1;
				$status=\data\utils\database\insert('INSERT into staff(email,institute) values(?,"center")',[$email,3],1);
				if($status==-1)
					return -1;

			}
			return 1;
		}
		else
		{
			if(check_existing($email)==0)
			{
				$status=\data\utils\database\insert('INSERT into premail(email,access) values(?,?)',[$email,4],1);
				if($status==-1)
					return -1;
				$status=\data\utils\database\insert('INSERT into staff(email,institute) values(?,"center")',[$email],1);
				if($status==-1)
					return -1;
			}
			$status=\data\utils\database\insert('INSERT into suballoc(email,course) values(?,?)',[$email,$course],1);
			if($status==-1)
				return -1;
			return 1;
		}
	}
	else
	{
		if($course=='all')
		{
			if(check_existing($email)==0)
			{
				$status=\data\utils\database\insert('INSERT into premail(email,access) values(?,?)',[$email,1],1);
				if($status==-1)
					return -1;
				$status=\data\utils\database\insert('INSERT into staff(email,institute) values(?,"center")',[$email],1);
				if($status==-1)
					return -1;
			}
			return 1;
			}	
		}
		else
		{
			if(check_existing($email)==0)
			{
				$status=\data\utils\database\insert('INSERT into premail(email,access) values(?,?)',[$email,2],1);
				if($status==-1)
					return -1;
				$status=\data\utils\database\insert('INSERT into staff(email,institute) values(?,?)',[$email,$institute],1);
				if($status==-1)
					return -1;
			}
			$status=\data\utils\database\insert('INSERT into suballoc(email,course) values(?,?)',[$email,$course],1);
			if($status==-1)
				return -1;
			return 1;	
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
			$users=\data\utils\database\find("SELECT email from premail where access=4 and email in (SELECT email from suballoc where course=? and email in (SELECT email from staff where institute='center'))",[$course],1);
			$users2=\data\utils\database\find("SELECT email from user where access=4 and email in (SELECT email from suballoc where course=? and email in (SELECT email from staff where institute='center'))",[$course],1);
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