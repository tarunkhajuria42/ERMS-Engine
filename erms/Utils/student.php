<?php
/*Student utils*/
namespace data\utils\student;

function add_student($student)
{
	return(\data\utils\database\insert('INSERT into student(email,institute,course,batch,fname,mname,dob,gender,category,allotcategory,address,phone,rollno) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)',$student,1));
}

function get_student($email,$rollno)
{
	if($email!==-1)
	{
		$arguments=[$email];
		$res=\data\utils\database\find('SELECT * from student where email=?',$arguments,1);
		if(count(res)>0)
			return $res;
		else
			return -1;
	}
	if($rollno!==-1)
	{
		$arguments=[$rollno];
		$res=\data\utils\database\find('SELECT * from student where rollno=?',$arguments,1);
		if(count(res)>0)
			return $res;
		else
			return -1;
	}
	else
		return -2;
}
function get_course($rollno)
{
	$arguments=[$rollno];
	$res=\data\utils\database\find('SELECT course from student where rollno=?',$arguments,1);
	if(count($res)>0)
		echo $res[0]['course'];
	else 
		echo -1;
}
function get_institute($rollno)
{
	$arguments=[$rollno];
	$res=\data\utils\database\find('SELECT institute from student where rollno=?',$arguments,1);
	if(count($res)>0)
		echo $res[0]['institute'];
	else 
		echo -1;
}
function get_batch($rollno)
{
	$arguments=[$rollno];
	$res=\data\utils\database\find('SELECT batch from student where rollno=?',$arguments,1);
	if(count($res)>0)
		echo $res[0]['batch'];
	else 
		echo -1;
}
?>