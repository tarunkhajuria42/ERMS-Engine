<?php
function add_subject($subject)
{
	if(\data\utils\database\insert('INSERT into subject(subject,course,semester,
		pitheory,mitheory,
		pipractical,mipractical,
		ppractical,mpractical,
		ptheory,mtheory
		) values(?,?,?,?,?,?,?,?,?,?,?)',$subject,1)==1)
			return 1;
		else 
			return -1;		

}
function add_institute($institute,$course)
{
	for ($i=0; $i<count($course); $i++)
	{	
		$arguments=[$institute,$course[$i]];
		if(\data\utils\database\insert('INSERT into institute(institute,course) values(?,?)',$arguments,1)==1)
		{
			
		}
		else 	
			return -1;		
	}
	return 1;
}
function get_courses($institute)
{
	$arguments=[$institute];
	$res=\data\utils\database\find('SELECT course from institute where institute=?',$arguments,1);
	if(count($res)>0)
	{
		return $res;
	}
	else
		return -1;
}

?>