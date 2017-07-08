<?php
/*Student utils*/
namespace data\utils\student;

function add_student($student)
{
	return(\data\utils\database\insert('INSERT into student(email,institute,course,batch,fname,mname,dob,gender,category,allotcategory,address,phone,rollno) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)',$student,1));
}

function get_student($email,$rollno)
{
	if($email!=-1)
	{
		$arguments=[$email];
		$res=\data\utils\database\find('SELECT * from student where email=?',$arguments,1);
		if(count($res)>0 && $res!=-1)
			return $res;
		else
			return -1;
	}
	if($rollno!=-1)
	{
		$arguments=[$rollno];
		$res=\data\utils\database\find('SELECT * from student where rollno=?',$arguments,1);
		if(count($res)>0 && $res!=-1)
			return $res;
		else
			return -1;
	}
	else
		return -1;
}
function get_course($rollno)
{
	$arguments=[$rollno];
	$res=\data\utils\database\find('SELECT course from student where rollno=?',$arguments,1);
	if(count($res)>0)
		return $res[0]['course'];
	else 
		return -1;
}
function get_institute($rollno)
{
	$arguments=[$rollno];
	$res=\data\utils\database\find('SELECT institute from student where rollno=?',$arguments,1);
	if(count($res)>0)
		return $res[0]['institute'];
	else 
		return -1;
}
function get_batch($rollno)
{
	$arguments=[$rollno];
	$res=\data\utils\database\find('SELECT batch from student where rollno=?',$arguments,1);
	if(count($res)>0)
		return $res[0]['batch'];
	else 
		return -1;
}
function get_screen($email)
{
	$student=get_student($email,-1);
	if($student!=-1)
	{
		$rollno=$student[0]['rollno'];
		$batch=$student[0]['batch'];
		$batch=\data\utils\student\get_batch($rollno);
		$res=\data\utils\marks\check_session();
		if($res==-1)
		{
			return -1;
		}
		$year=$res[0]['year'];
		if($res[0]['sessionid']>4)
			$addsem=2;
		else
			$addsem=1;
		$current_semester=($year-$batch)*2+$addsem;
		$course=$student[0]['course'];
		$max_sem=\data\utils\course\max_semester($course);
		if($current_semester>$max_sem)
		{
			$current_semester=$max_sem;
		}
		$screen=[];
		for ($semester=1; $semester<=$current_semester;$semester++)
		{
			$temp_dict['semester']=$semester;
			if($semester==$current_semester)
			{
				if($res[0]['sessionid']==4 || $res[0]['sessionid']==9)
					$temp_dict['marks_sheet']=1;
				else if($res[0]['sessionid']==2 || $res[0]['sessionid']==7)
					$temp_dict['marks_sheet']=2;
				else if($res[0]['sessionid']==1 || $res[0]['sessionid']==6)
					$temp_dict['marks_sheet']=3;
				else
					$temp_dict['marks_sheet']=0;	
			}
			else
			{
				$temp_dict['marks_sheet']=1;
			}
			array_push($screen, $temp_dict);
		}
		return $screen;
	}
	else
		return -1;
}
?>