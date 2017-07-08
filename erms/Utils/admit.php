<?php
/* Admit Module */
namespace data\utils\admit;
function admit_details($email)
{
	$student=\data\utils\student\get_student($email,-1);
	$regular=regular_papers($student['rollno']);
	$back=back_papers($student['rollno']);
	$choice=choice_papers($student['rollno']);
	if($regular!=-1)
		$temp_dict['regular_papers']=$regular;
	else
		return -1;
	if($back!=-1)
		$temp_dict['back_papers']=$back;
	else
		return -1;
	if($choice!=-1)
		$temp_dict['choice_papers']=$choice;
	else
		return -1;
	$temp_dict['rollno']=$student['rollno'];
	$temp_dict['name']=$student['name'];
	$temp_dict['course']=$student['course'];
	$temp_dict['institute']=$student['institute'];
	$temp_dict['centre']=allocate_center($student['rollno']);

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
	$choice=choice_papers($student['rollno']);
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
	var_dump($back);

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
			$total_pass=$sub[$i]['pipractical']+$sub[$i]['pitheory']+$sub[$i]['ppractical']+$sub[$i]['ptheory'];
			for($type=0; $type<4; $type++)
			{
				$arguments=[$sub[$i]['subject'],$rollno,$type];
			$marks=\data\utils\database\find('SELECT MAX(marks) from marks where subject=? and rollno=? and type=?',$arguments,1);
				if(count($marks)>0)
				{
					$total=$total+$marks[0]['MAX(marks)'];
				}
			}
			if($total<$total_pass)
			{
				array_push($list,[$sub[$i]['subject'],$sub[$i]['subject_code']]);
			}
				
		}
	}
	return $list;
}
function choice_papers($rollno)
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
	$arguments=[$semester,$course,1];

	$res=\data\utils\database\find('SELECT subject,subject_code from subject where semester=? and course=? and optional=?',$arguments,1);
	if($res!=-1)
		return $res;
	else
		return -1;
}
function add_record($photo,$signature,$rollno,$regular,$choice,$back)
{
	$centre=allocate_center($rollno);
	$id=\data\utils\database\find('SELECT MAX(id) from admit');
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
	//Insert into asubjects
	for($i=0; $i<count($regular); $i++)
	{
		add_subject($regular[$i],$id,0);
	}
	for($i=0; $i<count($choice); $i++)
	{
		add_subject($choice[$i],$id,0);
	}
	for($i=0; $i<count($choice); $i++)
	{
		add_subject($back[$i],$id,0);
	}
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
	$res=\data\utils\database('SELECT DISTINCT institute from institute where institute <> ?',$arguments,1);
	if(count($res)>0)
	{
		$ind=\rand(0,count($res));
		return $res[$ind]['institute'];
	}
	else
		return -1;
}

?>