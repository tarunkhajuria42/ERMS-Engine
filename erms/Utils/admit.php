<?php
/* Admit Module */
namespace data\utils\admit;
function admit_details($email)
{
	$res=\data\utils\marks\check_session();
	$student=\data\utils\student\get_student($email,-1);
	if($res==-1)
	{
		return -1;
	}
	$year=$res[0]['year'];
	$batch=\data\utils\student\get_batch($student[0]['rollno']);
	if($res[0]['sessionid']>4)
		$addsem=2;
	else
		$addsem=1;
	$semester=(($year-$batch)*2)+$addsem;
	
	$arguments=[$student[0]['rollno'],$year,$semester];
	$subjects=\data\utils\database\find('SELECT subject_code,subject from subject where subject in(SELECT subject from asubjects where id in(SELECT id from admit where rollno=? and year=? and semester=?))',$arguments,1);
	if($subjects!=-1)
	{
		
		$temp_array=[];
		for ($i=0; $i<count($subjects);$i++)
		{
			$date=\data\utils\database\find('SELECT date,slot from datesheet where subject=? and year=?',[$subjects[$i]['subject'],$year],1);
		if($date==-1)
			return -1;
		else if (count($date)==0)
		{
			$date='-';
			$slot='-';
		}
		else
		{
			$slot=$date[0]['slot'];
			$date=$date[0]['date'];
		}
			array_push($temp_array,[$subjects[$i]['subject_code'],$subjects[$i]['subject'],$date,$slot]);
		}
		$temp_dict['list']=$temp_array;
	}
	else
		return -1;
	$temp_dict['rollno']=$student[0]['rollno'];
	$temp_dict['name']=$student[0]['name'];
	$temp_dict['course']=$student[0]['course'];
	$temp_dict['institute']=$student[0]['institute'];
	$temp_dict['semester']=$semester;
	$arguments=[$student[0]['rollno'],$year,$semester];
	$admit=\data\utils\database\find('SELECT * from admit where rollno=? and year=? and semester=?',$arguments,1);
	if($admit==-1)
		return -1;
	$temp_dict['exam_centre']=$admit[0]['center'];
	$temp_dict['photo']=$admit[0]['photo'];
	$temp_dict['signature']=$admit[0]['signature'];

	return $temp_dict;


}
function exam_form($email)
{
	$res=\data\utils\student\get_student($email,-1);
	if($res!=-1)
		$student=$res[0];	
	else
		return -1;
	$temp_dict['rollno']=$student['rollno'];
	$regular=regular_papers($student['rollno']);
	$back=back_papers($student['rollno']);
	$choice=elective_papers($student['rollno']);
	if($regular!=-1)
		$temp_dict['regular']=$regular;
	else
		return -1;
	if($back!=-1)
		$temp_dict['back']=$back;
	else if(count($back)==0)
		$temp_dict['back']=[];
	else
		return -1;
	if($choice!=-1)
		$temp_dict['electives']=$choice;
	else
		return -1;
	return $temp_dict;

}
function regular_papers($rollno)
{

	$res=\data\utils\marks\check_session();
	if($res==-1)
	{
		return -1;
	}
	$year=$res[0]['year'];
	$batch=\data\utils\student\get_batch($rollno);
	if($res[0]['sessionid']>4)
		$addsem=2;
	else
		$addsem=1;
	$semester=($year-$batch)*2+$addsem;
	$course=\data\utils\student\get_course($rollno);
	$arguments=[$semester,$course,0];
	$res=\data\utils\database\find('SELECT subject,subject_code from subject where semester=? and course=? and optional=?',$arguments,1);
	if($res!=-1)
		return $res;
	else
		return -1;

}
function back_papers($rollno)
{
	$res=\data\utils\marks\check_session();
	if($res==-1)
	{
		return -1;
	}
	$year=$res[0]['year'];
	$batch=\data\utils\student\get_batch($rollno);
	if($res[0]['sessionid']>4)
		$addsem=2;
	else
		$addsem=1;
	$semester=($year-$batch)*2+$addsem;
	$course=\data\utils\student\get_course($rollno);
	$list=[];
	for($temp=$semester;$temp>0;$temp=$temp-2)
	{
		$arguments=[$course,$semester,$rollno];
		$sub=\data\utils\database\find('SELECT * from subject where course=? and semester=? and subject in (SELECT subject from asubjects where id in(SELECT id from admit where rollno=?))',$arguments,1);
		for($i=0; $i<count($sub);$i++)
		{
			$total=0;
			$total_pass=$sub[$i]['ptheory'];
			$arguments=[$sub[$i]['subject'],$rollno,3];
			$marks=\data\utils\database\find('SELECT MAX(marks) from marks where subject=? and rollno=? and type=?',$arguments,1);
				if($marks!=-1)
					$total=$marks[0]['MAX(marks)'];
				else
					return -1;
			if($total<$total_pass)
			{
				$temp_dict['subject']=$sub[$i]['subject'];
				$temp_dict['subject_code']=$sub[$i]['subject_code'];
				array_push($list,$temp_dict);
			}
				
		}
	}
	return $list;
}

function elective_papers($rollno)
{
	$res=\data\utils\marks\check_session();
	if($res==-1)
	{
		return -1;
	}
	$year=$res[0]['year'];
	$batch=\data\utils\student\get_batch($rollno);
	if($res[0]['sessionid']>4)
		$addsem=2;
	else
		$addsem=1;
	$semester=($year-$batch)*2+$addsem;
	$course=\data\utils\student\get_course($rollno);
	$institute=\data\utils\student\get_institute($rollno);
	$arguments=[$semester,$course,1,$institute];

	$res=\data\utils\database\find('SELECT subject,subject_code from subject where semester=? and course=? and optional=? and subject in(SELECT subject from choice where institute=?)',$arguments,1);
	return $res;
}
function add_record($photo,$signature,$rollno,$regular,$choice,$back)
{
	$centre=allocate_center($rollno);
	if($centre==-1)
		return -1;
	$id=\data\utils\database\find('SELECT MAX(id) from admit',[],1);
	$id=$id[0]['MAX(id)']+1;
	$res=\data\utils\marks\check_session();
	if($res==-1)
	{
		return -1;
	}
	$year=$res[0]['year'];
	$batch=\data\utils\student\get_batch($rollno);
	if($res[0]['sessionid']>4)
		$addsem=2;
	else
		$addsem=1;
	$semester=($year-$batch)*2+$addsem;
	//Insert into admit
	$arguments=[$id,$centre,$photo,$signature,$year,$semester,$rollno];
	$submit=\data\utils\database\insert('INSERT into admit(id,center,photo,signature,year,semester,rollno) values(?,?,?,?,?,?,?)',$arguments,1);
	if($submit==-1)
		return -1;
	//Insert into asubjects
	for($i=0; $i<count($regular); $i++)
	{
		if(add_subject($regular[$i],$id,0)==-1)
			return -1;
	}
	for($i=0; $i<count($choice); $i++)
	{
		if(add_subject($choice[$i],$id,1)==-1)
			return -1;
	}
	for($i=0; $i<count($back); $i++)
	{
		if(add_subject($back[$i],$id,2)==-1)
			return -1;
	}
	return 1;
}

function add_subject($subject,$id,$type)
{
	$arguments=[$subject,$id,$type];
	return(\data\utils\database\insert('INSERT into asubjects(subject,id,type) VALUES(?,?,?)',$arguments,1));
}
function allocate_center($rollno)
{
	$institute=\data\utils\student\get_institute($rollno);
	$arguments=[$institute];
	$res=\data\utils\database\find('SELECT DISTINCT institute from courses where institute <> ?',$arguments,1);
	if($res!=-1)
	{
		$ind=\rand(0,count($res)-1);
		return $res[$ind]['institute'];
	}
	else
		return -1;
}

?>