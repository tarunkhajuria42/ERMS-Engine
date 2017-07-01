<?php
/* 
Marks Module
Examination Management System 0.1
Utility functions
*/
namespace data\utils\marks;
function addMarks($marks,$type,$rollno,$subject)
{
	$res=\data\utils\marks\check_session();
	if($res==-1)
	{
		return -1;
	}
	$year=$res[0]['year'];
	$arguments=[$marks,$type,$rollno,$subject,$year];
	return(\data\utils\database\insert('INSERT into marks(marks,type,rollno,subject,year) VALUES(?,?,?,?,?)',$arguments,1));
}
function editMarks($rollno,$type,$subject,$marks)
{
	$res=\data\utils\marks\check_session();
	if($res==-1)
	{
		return -1;
	}
	$year=$res[0]['year'];
	$arguments=[$type,$subject,$year,$rollno,$marks];
	return(\data\utils\database\update('UPDATE marks SET marks=? WHERE $type=? and $rollno=? and $subject=? and $year=?',$arguments,1));
	
}
function getMarks($rollno,$subject,$type)
{
	$res=\data\utils\marks\check_session();
	if($res==-1)
	{
		return -1;
	}
	$year=$res[0]['year'];
	$arguments=[$rollno,$subject,$year,$type];
	$res=\data\utils\database\find('SELECT marks from marks where rollno=? and subject=? and year=? and type=?',$arguments,1);
	if(count($res)>0)
	{
		return $res;
	}
	else
		return -1;
}
function getMarks_institute($institute,$subject,$type){
	$res=\data\utils\marks\check_session();
	if($res==-1)
	{
		return -1;
	}
	$year=$res[0]['year'];
	$arguments=[$subject,$year,$type,$institute];
	$res=\data\utils\database\find('SELECT rollno,marks from marks where subject=? and year=? and type=? and rollno in(SELECT rollno from student where institute=?)',$arguments,1);
	if(count($res)>0)
	{
		return $res;
	}
	else
		return -1;
}
function find_subjects($course,$institute)
{
	if($course='all' && $institute=='all')
	{
		$subjects_insitute=\data\utils\data\find('SELECT subject.* , courses.institute  from subject INNER JOIN courses ON subject.institute=courses.institute',[],1);
	}
	else if($course=='all')
	{
		$arguments=[$course];
		$subjects_institute=\data\utils\data\find('SELECT subject.*, courses.institute from subject INNER JOIN courses ON subject.institute=course.institute and courses.institute=?',$arguments,1);
	}
	else if($institute='all')
	{
		$arguments=[$course];
		$subjects_institute=\data\utils\data\find('SELECT subject.*, course.institute from subject INNER JOIN courses ON subject.institute=course.institute and courses.course=?',$arguments,1);
	}
	$lists=[];
	for($i=0;$i<count($subjects_institute);$i++)
	{
		if($subjects_institute['mpractical']!==0)
		{
			$mpractical=-1;
		}
		else
		{
			$mpractical=2;
		}
		if($subjects_institute['mipractical']!==0)
		{
			$mipractical=-1;
		}
		else
		{
			$mipractical=1;
		}
		if($subjects_institute['mitheory']!==0)
		{
			$mitheory=-1;
		}
		else
		{
			$mitheory=0;
		}	
		if($subjects_institute['mtheory']!==0)
		{
			$mtheory=-1;
		}
		else
		{
			$mtheory=1;
		}
		$temp_dict['subject_code']=$subjects_institute['subject_code'];
		$temp_dict['institute']=$subjects_institute['institute'];
		if(check_entry($subjects_institute[$i]['subject'],$subjects_institute[$i]['institute'],$mipractical)!=-1)
		{
			$temp_dict['internal_theory']=check_entry($subjects_institute[$i]['subject'],$subjects_institute[$i]['institute'],$mipractical);	
		}
		else 
			return -1;
		if(check_entry($subjects_institute[$i]['subject'],$subjects_institute[$i]['institute'],$mitheory)!=-1)
		{
			$temp_dict['internal_practical']=check_entry($subjects_institute[$i]['subject'],$subjects_institute[$i]['institute'],$mitheory);
		}
		else 
			return -1;
		if(check_entry($subjects_institute[$i]['subject'],$institute[$i]['institute'],$mpractical)!=-1)
		{
			$temp_dict['external_practical']=check_entry($subjects_institute[$i]['subject'],$institute[$i]['institute'],$mpractical);	
		}
		else 
			return -1;
		if(check_entry($subjects_institute[$i]['subject'],$subjects_institute['institute'],$mtheory)!=-1)
		{
			$temp_dict['external_theory']=check_entry($subjects_institute[$i]['subject'],$subjects_institute['institute'],$mtheory);	
		}
		else
			return -1;		
		array_push($lists,$temp_dict);	
	}
	return $lists;
}
function check_entry($subject,$institute,$paper)
{
	if($paper==-1)
		return -1;
	else
	{
		$arguments=[$ubject,$institute];	
		$res=\data\utils\data\find('SELECT COUNT(*) from asubjects where subject=? and year=? and id in(select id from admin where institute=?',$arguments,1);
		if($res!=-1)
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
	if(count($res)>0)
		return $res;
	else
		return -1;
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
