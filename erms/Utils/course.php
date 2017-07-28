<?php
namespace data\utils\course;
function all_institutes()
{
	$arguments=[];
	$res=\data\utils\database\find('SELECT DISTINCT institute from courses',$arguments,1);
	if($res!=-1 )
		return $res;
	else
		return -1;
}
function add_courses($institute,$course)
{
	for ($i=0; $i<count($course); $i++)
	{	
		$arguments=[$institute,$course[$i]];
		if(\data\utils\database\insert('INSERT into courses(institute,course) values(?,?)',$arguments,1)!=-1)
		{
		}
		else 	
			return -1;		
	}
	return 1;
}
function delete_courses($institute,$course)
{
	for ($i=0; $i<count($course); $i++)
	{	
		$arguments=[$institute,$course[$i]];
		if(\data\utils\database\delete('DELETE from courses where institute=? and course=?',$arguments,1)!=-1)
		{
			
		}
		else 	
			return -1;		
	}
	return 1;	
}
function get_courses($institute)
{
	if($institute=='all')
	{
		$arguments=[];
		$res=\data\utils\database\find('SELECT DISTINCT course from courses',$arguments,1);
		if($res !=-1)
			return $res;
		else
			return -1;	
	}
	else
	{
		$arguments=[$institute];
		$res=\data\utils\database\find('SELECT course from courses where institute=?',$arguments,1);
		if($res !=-1)
			return $res;
		else
			return -1;	
	}
	
}
function all_courses()
{
	$courses=[];
	$res=\data\utils\database\find('SELECT DISTINCT course from subject',$courses,1);
	if($res!=-1)
	{
		for($i=0; $i<count($res); $i++)
		{
			array_push($courses,$res[$i]['course']);
		}
		return $courses;
	}
	else
	{
		return -1;
	}
}
function get_semesters($institute,$course)
{
	$res=\data\utils\marks\check_session();
	if($res==-1)
	{
		return -1;
	}
	if($res[0]['sessionid']>4)
		$rem=0;
	else
		$rem=1;
	if($course=='all')
	{
		if($institute=='all')
		{
			$sem=\data\utils\database\find('SELECT DISTINCT semester from subject where semester%2=?',[$rem],1);	
		}
		else
		{
			$arguments=[$rem,$institute];
			$sem=\data\utils\database\find('SELECT DISTINCT semester from subject where semester%2=? and course in (SELECT course from courses where institute=?)',$arguments,1);
		}
	}
	else 
	{	
		$arguments=[$rem,$course];
		$sem=\data\utils\database\find('SELECT DISTINCT semester from subject where semester%2=? and course=?',$arguments,1);	
	}
	return $sem;
}
function get_subjects($course)
{
	$arguments=[$course];
	$res=\data\utils\database\find('SELECT * from subject where course=?',$arguments,1);
	return $res;
}
function add_subjects($course,$subjects)
{

	for($i=0;$i<count($subjects);$i++)
	{
		$arguments=[
				$subjects[$i]['subject_code'],
				$subjects[$i]['subject'],
				$subjects[$i]['semester'],
				$course,
				$subjects[$i]['pipractical'],
				$subjects[$i]['mipractical'],
				$subjects[$i]['pitheory'],
				$subjects[$i]['mitheory'],
				$subjects[$i]['ppractical'],
				$subjects[$i]['mpractical'],
				$subjects[$i]['ptheory'],
				$subjects[$i]['mtheory'],
				$subjects[$i]['optional'],
				];
	if(\data\utils\database\insert('INSERT into subject(subject_code,
		subject,
		semester,
		course,
		pipractical,
		mipractical,
		pitheory,
		mitheory,
		ppractical,
		mpractical,
		ptheory,
		mtheory,
		optional
		) values(?,?,?,?,?,?,?,?,?,?,?,?,?)',$arguments,1)!=-1)
			{
			}
		else 
			return -1;		
	}
	return 1;
}
function delete_subjects($course,$subjects)
{
	for ($i=0; $i<count($subjects);$i++)
	{
		$arguments=[$subjects[$i]['subject_code']];
		if(\data\utils\database\delete('DELETE from subject where subject_code=?',$arguments,1)!=-1)	
			{

			}
		else
			return -1;
	}
	return 1;
}
function edit_subjects($course,$subjects)
{
	for($i=0;$i<count($subjects);$i++)
	{
		$arguments=[
				$subjects[$i]['subject'],
				$subjects[$i]['semester'],
				$course,
				$subjects[$i]['pipractical'],
				$subjects[$i]['mipractical'],
				$subjects[$i]['pitheory'],
				$subjects[$i]['mitheory'],
				$subjects[$i]['ppractical'],
				$subjects[$i]['mpractical'],
				$subjects[$i]['ptheory'],
				$subjects[$i]['mtheory'],
				$subjects[$i]['optional'],
				$subjects[$i]['subject_code']

				];
	if(\data\utils\database\update('UPDATE subject SET
		subject=?,
		semester=?,
		course=?,
		pipractical=?,
		mipractical=?,
		pitheory=?,
		mitheory=?,
		ppractical=?,
		mpractical=?,
		ptheory=?,
		mtheory=?,
		optional=?
		where subject_code=?',$arguments,1)!=-1)
			{}
		else 
			return -1;		
	}
	return 1;
}
function max_semester($course)
{
	$arguments=[$course];
	$res=\data\utils\database\find('SELECT MAX(semester) from subject where course=?',$arguments,1);
	if($res!=-1)
	{
		return $res[0]['MAX(semester)'];
	}
}
//************************************************ Choice of Subjects*****************************************
function get_choice($institute,$course)
{
	$list=\data\utils\database\find('SELECT subject,semester from subject where optional=? and course=?',[1,$choice],1);
	$list_added=\data\utils\database\find('SELECT subject from choice where institute=? and course=?',[$institute,$choice],1);
	if($list==-1 || $list_added==-1)
		return -1;
	$added_list=[];
	for($i=0;$i<count($list_added);$i++)
	{
		array_push($added_list,$list_added[$i]['subject']);
	}
	for($i=0;$i<count($list);$i++)
	{
		if(in_array($list[$i]['semester'],$added_list))
			$list[$i]['choice']=1;
		else
			$list[$i]['choice']=0;
	}
	return $list;
}
function add_choice($subjects,$course,$institute)
{
	for($i=0; $i<count($subject);$i++)
	{
		$res=\data\utils\database\insert('INSERT into choice(subject,course,institute) values(?,?,?)',[$subject[$i],$choice,$institute],1);
		if($res==-1)
			return -1;
	}
	return 1;
}	
function delete_choice($subjects,$course,$institute)
{
	for($i=0; $i<count($subject);$i++)
	{
		$res=\data\utils\database\delete('DELETE from choice where subject=? and course=? and institute=?',[$subject[$i],$course,$institute],1);
		if($res==-1)
			return -1;
	}
	return 1;
}
?>