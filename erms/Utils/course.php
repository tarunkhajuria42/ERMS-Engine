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
	$arguments=[];
	if($institute='all')
	{
		$res=\data\utils\database\find('SELECT DISTINCT course from course',$arguments,1);
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
function get_subjects($course)
{
	$arguments=[$course];
	$res=\data\utils\database\find('SELECT * from subject where course=?',$arguments,1);
	return $res;
}
function add_subjects($course,$subjects)
{

	echo(count($subjects));
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
				var_dump($arguments);
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
?>