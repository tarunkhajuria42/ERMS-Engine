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
function check_vocational($rollno)
{
	$arguments=[$rollno];
	$res=\data\utils\database\find('SELECT vocational from student where rollno=?',[$rollno],1);
	if(count($res)>0 and $res!=-1)
	{
		return $res[0]['vocational'];
	}
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
		$current_semester=(($year-$batch)*2)+$addsem;
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
				{

					$id=\data\utils\database\find('SELECT COUNT(*) from admit where rollno=? and year=? and semester=?',[$rollno,$year,$current_semester],1);
					if($id[0]['COUNT(*)']>0)
						$temp_dict['marks_sheet']=4;
					else
						$temp_dict['marks_sheet']=3;
				}
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
function add($a,$b)
{
	if($a=='-')
		$a=0;
	if($b=='-')
		$b=0;
	return $a+$b;
	
}
function get_marksheet($user,$semester)
{
	$student=get_student($user,-1);
	if($student!=-1)
	{
		$course=$student[0]['course'];
		$institute=$student[0]['institute'];
		$rollno=$student[0]['rollno'];
		$arguments=[$semester,$course,$course,$institute];
		$subjects=\data\utils\database\find('SELECT * from subject where semester=? and course=? and (optional=0 || (optional =1 and subject in (SELECT subject from choice where course=? and institute=?)))',$arguments,1);
		$temp=[];
		for ($i=0; $i<count($subjects);$i++)
		{
			$array=[$subjects[$i]['subject_code'],$subjects[$i]['subject'],
			$subjects[$i]['minternal'],$subjects[$i]['mexternal'],$subjects[$i]['minternal']+$subjects[$i]['mexternal']
			];
			$type_array=[0,1];
			for($j=0; $j<2;$j++)
			{
				$type=$type_array[$j];
				$marks=\data\utils\database\find('SELECT MAX(marks) from marks where rollno=? and subject=? and type=?',[$rollno,$subjects[$i]['subject'],$type],1);
				if($marks==-1)
					return -1;
				if($marks[0]['MAX(marks)']==null)
				{
					array_push($array,'-');
				}
				else
				{
					array_push($array,$marks[0]['MAX(marks)']);
				}
				if($type==1)
				{

					array_push($array,add($array[count($array)-1],$array[count($array)-2]));
				}
			}
			array_push($temp,$array);
		}
		$total=['','Total',0,0,0,0,0,0];
		for($i=0;$i<count($temp);$i++)
		{
			for($type=2;$type<count($total);$type++)
			{
				$total[$type]=add($temp[$i][$type],$total[$type]);
			}
		}
		array_push($temp,$total);
		$temp_dict['name']=$student[0]['name'];
		$temp_dict['rollno']=$student[0]['rollno'];
		$temp_dict['institute']=$institute;
		$temp_dict['course']=$course;
		$temp_dict['semester']=$semester;
		$temp_dict['list']=$temp;
		$temp_dict['total']=$total[7];
		$temp_dict['percent']=round($temp_dict['total']*100/($total[4]));
		$temp_dict['division']='First';
		if($temp_dict['percent']>40)
			$temp_dict['pass']='Pass';
		else
			$temp_dict['pass']='Fail';
		
		return $temp_dict;
	}
	else
		return -1;
}


?>