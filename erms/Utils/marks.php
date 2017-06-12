<?php
/* 
Marks Module
Examination Management System 0.1
Utility functions
*/
namespace data\utils\marks;
function addMarks($marks,$type,)
{
	$arguments=
}
function editMarks()
{
	
}
function getMarks()
{
	
}
function find_subjects($course,$institute)
{
	if($course='all' && $institute=='all')
	{
		$subjects=\data\utils\data\find('SELECT * from subject',[],1);
		$institutes=\data\utils\data\find('SELECT DISTINCT institute from institute',[],1);
	}
	else if($course=='all')
	{
		$arguments=[$course];
		$subject=\data\utils\data\find('SELECT * from subject where course in (SELECT course from courses where institute=?');
	}
	else if($institute='all')
	{
		$arguments=[$course];
		$subjects=\data\utils\data\find('SELECT * from subject where course =?',$arguments,1);
		$institutes=\data\utils\data\find('SELECT * from courses where course =?',$arguments,1);
	}
	$lists=[];
	for($i=0;$i<count($subjects);$i++)
	{
		for($j=0;$j<count($institutes);$j++)
		{
			if($subject['mpractical']!==0)
			{
				$mpractical=-1;
			}
			else
			{
				$mpractical=2;
			}
			if($subject['mipractical']!==0)
			{
				$mipractical=-1;
			}
			{
				$mipractical=1;
			}
			if($subject['mitheory']!==0)
			{
				$mitheory=-1;
			}
			else
			{
				$mitheory=0;
			}
			if($subject['mtheory']!==0)
			{
				$mtheory=-1;
			}
			array_push($lists,
				[$subject[$i]['subject'],
				$institute[$i]['institute'],
				check_entry($subject[$i]['subject'],$institute[$i]['institute'],$mitheory),
				check_entry($subject[$i]['subject'],$institute[$i]['institute'],$mipractical),
				check_entry($subject[$i]['subject'],$institute[$i]['institute'],$mpractical),
				check_entry($subject[$i]['subject'],$institute[$i]['institute'],$mtheory)
				]);
		}	
	}
	echo($lists);
}
function check_entry($subject,$institute,$paper)
{
	if($paper==-1)
		return -1;
	else
	{
		$arguments=[$ubject,$institute];	
		$res=\data\utils\data\find('SELECT COUNT(*) from asubjects where subject=? and year=? and id in(select id from admin where institute=?',$arguments,1);
		if(count($res)>0)
		{
			$arguments2=[];
			$res2=\data\utils\data\find('SELECT COUNT(*) from marks where subject=? and year=? and $paper=?',$arguments,1);
			if($res1[0]['COUNT(*)']==$res[0]['COUNT(*)'])
				return 1;
			else
				return 0;
		}	
		else
			 return -1;	
		}
	}
}
function find_batch($course)
{
	$arguments=[$course];
	$res=\data\utils\database\find('SELECT max(semester) as maxi from subjects where course=?',$arguments,1);
	if(count($res)>0)
		return $res[0]['maxi'];
	else
		return -1;

}
function check_session()
{
	$arguments=[0];
	$res=\data\utils\database\find('SELECT year,sessionid from session where completed=?',$arguments,1);
		return $res;
}
function new_session($email)
{
	$arguments=[0];
	$res=\data\utils\database\find('SELECT year,sessionid from session where completed=?',$arguments,1);
	if(count($res)>0)
	{
		$session=$res[0]['sessionid']+1;
		$year=$res[0]['year'];	
		if($session>9)
		{
			$session=0;
			$year=$year+1;
		}
	}
	else
	{
		$session=0;
		$year=2017;
	}
	$arguments=[1,0];
	if(\data\utils\database\update('UPDATE session SET completed=? where completed=?',$arguments,1)==1)
	{
		$arguments=[$year,$session,0,$email];
		if(\data\utils\database\insert('INSERT into session(year,sessionid,completed,email) values(?,?,?,?)',$arguments,1)==1)
			return 1;
		else
			return -1;
	}
	else 
		return -1;
}
function prev_session($email)
{

}
function timeZone($time)
{
	$tz = 'Asia/Calcutta';
	$dt = new \DateTime("now", new \DateTimeZone($tz)); //first argument "must" be a string
	$dt->setTimestamp($time); //adjust the object to correct timestamp
	return ($dt->format('Y'));	
}
