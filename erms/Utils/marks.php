<?php
/* 
Marks Module
Examination Management System 0.1
Utility functions
*/
namespace data\utils\marks;
function get_max($subject,$type)
{
	$t=['minternal','mexternal'];
	$max=\data\utils\database\find('SELECT * from subject where subject=?',[$subject],1);
	if($max!=-1)
	{
		return $max[0][$t[$type]];
	}
	else
		return -1;
}
function check_data($data)
{
	$res=\data\utils\marks\check_session();
	if($res==-1)
	{
		return -1;
	}
	$year=$res[0]['year'];
	$batch=\data\utils\student\get_batch($data[0]['rollno']);
	$vocational=\data\utils\student\check_vocational($data[0]['rollno']);
	if($vocational==-1)
		return -1;
	$add_voc=[0,2];
	if($res[0]['sessionid']>4)
		$addsem=2;
	else
		$addsem=1;
	$semester=($year-$batch)*2+$addsem+$add_voc[$vocational];
	$res=\data\utils\database\find('SELECT COUNT(*) from asubjects  where subject=? and  id =(Select id from admit where rollno=? and year=? and semester=?)',[$data[0]['subject'],$data[0]['rollno'],$year,$semester],1);
	if($res==-1)
		return -1;
	if($res[0]['COUNT(*)']==0)
		return -1;
	else
	{
		$max=get_max($data[0]['subject'],1);
		if($max>=$data[0]['marks'])
			return 1;
		else
			return -1;
	}
		
}
function submit_marks($records)
{
	$res=\data\utils\marks\check_session();
	if($res==-1)
	{
		return -1;
	}
	$year=$res[0]['year'];
	if(isset($records[0]['institute_id']))
	{
		for ($i=0; $i<count($records);$i++)
		{
			$arguments=[$records[$i]['institute_id'],$records[$i]['type'],$records[$i]['rollno'],$records[$i]['subject'],$year];
			$res=\data\utils\database\update('UPDATE marks SET institute_id=? WHERE type=? and rollno=? and subject=? and year=?',$arguments,1);
			if($res!=-1)
			{

			}	
			else
				return -1;
		}
		return 1;
	}
	else
	{
		for ($i=0; $i<count($records);$i++)
		{
			$arguments=[$records[$i]['board'],$records[$i]['type'],$records[$i]['rollno'],$records[$i]['subject'],$year];
			$res=\data\utils\database\update('UPDATE marks SET board=? WHERE type=? and rollno=? and subject=? and year=?',$arguments,1);
			if($res!=-1)
			{

			}	
			else
				return -1;
		}
		return 1;
	}
	
}
function dist_grace()
{
	$res=\data\utils\marks\check_session();
	if($res==-1)
	{
		return -1;
	}
	$year=$res[0]['year'];
	$students=\data\utils\database\find('SELECT * from admit where year=?',[$year],1);
	if($students!=-1)
	{
		for($i=0; $i<count($students);$i++)
		{
			$batch=\data\utils\student\get_batch($students[$i]['rollno']);
			$vocational=\data\utils\student\check_vocational($students[$i]['rollno']);
			$course=\data\utils\student\get_course($students[$i]['rollno']);
			if($vocational==-1)
				return -1;
			$add_voc=[0,2];
			if($res[0]['sessionid']>4)
				$addsem=2;
			else
				$addsem=1;
			$semester=($year-$batch)*2+$addsem+$add_voc[$vocational];
			//$subjects=\data\utils\database\find('SELECT marks, subject,type from marks where rollno=? and year=?',[$students[$i]['']])
		}
	}

}
function add_marks($records)
{
	$res=\data\utils\marks\check_session();
	if($res==-1)
	{
		return -1;
	}
	$year=$res[0]['year'];
	for ($i=0; $i<count($records);$i++)
	{
		$arguments=[$records[$i]['marks'],$records[$i]['type'],$records[$i]['rollno'],$records[$i]['subject'],$year,$records[$i]['entry']];
		$res=\data\utils\database\insert('INSERT into marks(marks,type,rollno,subject,year,entry)VALUES(?,?,?,?,?,?)',$arguments,1);
		if($res!=-1)
		{

		}	
		else
			return -1;
	}
	return 1;
}
function edit_marks($records)
{
	$res=\data\utils\marks\check_session();
	if($res==-1)
	{
		return -1;
	}
	$year=$res[0]['year'];
	for ($i=0; $i<count($records);$i++)
	{
		$arguments=[$records[$i]['marks'],$records[$i]['comment'],$records[$i]['last_edit'],$records[$i]['type'],$records[$i]['rollno'],$records[$i]['subject'],$year];
		$res=\data\utils\database\update('UPDATE marks SET marks=?, comment=?, last_edit=? WHERE type=? and rollno=? and subject=? and year=?',$arguments,1);
		if($res!=-1)
		{

		}	
		else
			return -1;
	}
	return 1;	
}
function get_marks($subject,$institute,$type)
{
	$res=\data\utils\marks\check_session();
	if($res==-1)
	{
		return -1;
	}
	$year=$res[0]['year'];
	$arguments=[$subject,$year,$type,$institute];
	$res=\data\utils\database\find('SELECT marks.rollno, marks.marks, student.name, marks.comment, marks.last_edit, marks.entry,marks.institute_id,marks.board from marks INNER JOIN  student ON marks.subject=? and marks.year=? and marks.type=? and marks.rollno=student.rollno and student.institute=?',$arguments,1);
	if($res!=-1)
		return $res;
	else
		return -1;
}
function get_students($subject,$institute,$type)
{

	$res=\data\utils\marks\check_session();
	if($res==-1)
	{
		return -1;
	}
	$year=$res[0]['year'];
	
	$sem=\data\utils\database\find('SELECT semester,course from subject where subject=?',[$subject],1);
	if($sem==-1)
		return -1;
	$batch=$year-round(($sem[0]['semester']-1)/2,0,PHP_ROUND_HALF_DOWN);

	$arguments=[$institute,$sem[0]['course'],$batch,0];
	$res=\data\utils\database\find('SELECT rollno from student where institute=? and course=? and batch=? and vocational=?',$arguments,1);
	$arguments=[$institute,$sem[0]['course'],$batch+1,1];
	$res2=\data\utils\database\find('SELECT rollno from student where institute=? and course=? and batch=? and vocational=?',$arguments,1);
	$res=array_merge($res,$res2);
	$students=[];
	if($res!=-1 and $res2!=-1)
	{
		for($i=0;$i<count($res);$i++)
		{
			$temp_dict['rollno']=$res[$i]['rollno'];
			$temp_dict['name']=get_student_name($res[$i]['rollno']);
			$temp_dict['marks']=get_student_marks($temp_dict['rollno'],$subject,$year,$type);
			if($temp_dict['name']==-1)
			{
				return -1;
			}
			if($temp_dict['marks']==-1)
			{
				return -1;
			}
			else if($temp_dict['marks']==-2)
				$temp_dict['marks']=-1;
			array_push($students,$temp_dict);
		}
	}
	else
		return -1;
	return $students;
}
function get_student_marks($rollno,$subject,$year,$type)
{
	$arguments=[$rollno,$subject,$year,$type];
	$res=\data\utils\database\find('SELECT marks from marks where rollno=? and subject=? and year=? and type=?',$arguments,1);
	if($res!=-1 and count($res)!=0)
		return $res[0]['marks'];
	else if(count($res)==0)
		return -2;
	else 
		return -1;
}
function get_student_name($rollno)
{
	$arguments=[$rollno];
	$res=\data\utils\database\find('SELECT name from student where rollno=?',$arguments,1);
	if($res!=-1)
	{
		return $res[0]['name'];
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
function find_subjects($course,$institute,$semester)
{	
	if($course=='all' && $institute=='all')
	{
		$subjects_institute=\data\utils\database\find('Select subject.*, courses.institute FROM subject INNER JOIN courses ON subject.course=courses.course and subject.semester=? and (subject.optional=0 || subject.subject in(SELECT subject from choice where institute=courses.institute and course=courses.course))',[$semester],1);
	}
	else if($course=='all')
	{
		$arguments=[$institute,$semester];
		$subjects_institute=\data\utils\database\find('SELECT subject.*, courses.institute from subject INNER JOIN courses ON subject.course=courses.course and courses.institute=? and subject.semester=? and (subject.optional=0 || subject.subject in(SELECT subject from choice where institute=courses.institute and course=courses.course))',$arguments,1);
	}
	else if($institute=='all')
	{
		$arguments=[$course,$semester];
		$subjects_institute=\data\utils\database\find('SELECT subject.*, courses.institute from subject INNER JOIN courses ON subject.course=courses.course and courses.course=? and subject.semester=? and (subject.optional=0 || subject.subject in(SELECT subject from choice where institute=courses.institute and course=courses.course))',$arguments,1);
	}
	else
	{
		$arguments=[$course,$institute,$semester];
		$subjects_institute=\data\utils\database\find('SELECT subject.*, courses.institute from subject INNER JOIN courses ON subject.course=courses.course and courses.course=? and courses.institute=? and subject.semester=? and (subject.optional=0 || subject.subject in(SELECT subject from choice where institute=courses.institute and course=courses.course))',$arguments,1);	
	}
	$lists=[];
	if($subjects_institute!=-1)
	{

		for($i=0;$i<count($subjects_institute);$i++)
		{
			if($subjects_institute[$i]['minternal']==0)
				$temp_dict['internal']=-1;	
			else if(check_entry($subjects_institute[$i]['subject'],$subjects_institute[$i]['institute'],0)!=-1)
				$temp_dict['internal']=check_entry($subjects_institute[$i]['subject'],$subjects_institute[$i]['institute'],0);
			else 
				return -1;
		if($subjects_institute[$i]['mexternal']==0)
			$temp_dict['external']=-1;
		else if(check_entry($subjects_institute[$i]['subject'],$subjects_institute[$i]['institute'],1)!=-1)
			$temp_dict['external']=check_entry($subjects_institute[$i]['subject'],$subjects_institute[$i]['institute'],1);	
		else 
			return -1;
		$temp_dict['subject']=$subjects_institute[$i]['subject'];
		$temp_dict['subject_code']=$subjects_institute[$i]['subject_code'];
		$temp_dict['institute']=$subjects_institute[$i]['institute'];
		$temp_dict['course']=$subjects_institute[$i]['course'];
		array_push($lists,$temp_dict);	
		}
		return $lists;	
	}
	else
	{
		return -1;
	}
}
function check_entry($subject,$institute,$paper)
{
		$session=check_session();
		if($session!=-1)
			$year=$session[0]['year'];
		else
			return -1;
		$arguments=[$subject,$year,$institute];	
		if($paper==1)
			$res=\data\utils\database\find('SELECT * from asubjects where subject=? and id in (SELECT id from admit where year=? and rollno in(SELECT rollno from student where institute=?))',$arguments,1);
		else
			$res=get_students($subject,$institute,$paper);
		if($res!=-1)
		{
			$arguments2=[$subject,$year,$paper,$institute];
			$res2=\data\utils\database\find('SELECT COUNT(*) from marks where subject=? and year=? and type=? and rollno in(SELECT rollno from student where institute=?)',$arguments2,1);	
			if($res2!=-1)
			{
				if(count($res)==0)
					return 2;
				if($res2[0]['COUNT(*)']==count($res))
					return 1;
				else
					return 0;	
			}
			else 
				return -1;
		}	
		else
			 return -1;	
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
//********************************************** Datesheet functions *********************************************
function get_datesheet($course,$semester)
{
	$res=\data\utils\marks\check_session();
		if($res==-1)
		{
			return -1;
		}
		$year=$res[0]['year'];
	$arguments=[$course,$semester];
	$subjects=\data\utils\database\find('SELECT subject from subject where course=? and semester=?',$arguments,1);
	if($subjects==-1)
		return -1;
	$sub_res=[];
	for($i=0; $i <count($subjects); $i++)
	{
		$arguments=[$subjects[$i]['subject'],$year,$semester];
		$date=\data\utils\database\find('SELECT date from datesheet where subject=? and year=? and semester=?',$arguments,1);
		if(count($date)==0)
			$temp['date']=-1;
		else
			$temp['date']=$date[0]['date'];
		$temp['subject']=$subjects[$i]['subject'];
		array_push($sub_res,$temp);
	}
	return $sub_res;
}

function add_datesheet($list)
{
	$res=\data\utils\marks\check_session();
		if($res==-1)
		{
			return -1;
		}
		$year=$res[0]['year'];
	for($i=0; $i<count($list);$i++)
	{
		$subject=$list[$i]['subject'];
		$semester=\data\utils\database\find('SELECT semester from subject where subject=?',[$subject],1);
		$arguments=[$list[$i]['date'],$year,$semester[0]['semester'],$subject];
		if($list[$i]['type']==0)
			$res=\data\utils\database\update('UPDATE datesheet SET date=? where year=? and semester=? and subject=?',$arguments,1);
		else
			$res=\data\utils\database\insert('INSERT into datesheet(date,year,semester,subject) values(?,?,?,?)',$arguments,1);
		if($res==-1)
			return -1;
	}
	return 1;
}
//**********************************************Session functions*************************************************

function check_session()
{
	$arguments=[0];
	$res=\data\utils\database\find('SELECT year,sessionid from session where completed=?',$arguments,1);
	if($res!=-1)
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
		$year=2016;
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
