<?php
namespace data;
function lists()
{
	if(isset($_POST['request']))
	{
		if(isset($_POST['data']))
		{
			$data=json_decode($_POST['data'],true);
		}
		switch($_POST['request'])
		{
			case 'all_institutes':
								$insti=utils\course\all_institutes();
								if($insti!=-1)
								{
									$institutes=[];
									for($i=0;$i<count($insti);$i++)
									{
										array_push($institutes,$insti[$i]['institute']);
									}
									echo(utils\reply('all_institutes','success',$institutes));	
								}
								else
									echo(utils\reply('all_institutes','error','system'));
								break;
			case 'get_courses':
								$cor=utils\course\get_courses($_POST['value']);
								if($cor!=-1)
								{
									$courses=[];
									for($i=0; $i<count($cor);$i++)
									{
										array_push($courses,$cor[$i]['course']);
									}
									echo(utils\reply('get_courses','success',$courses));
								}
								else
									echo(utils\reply('get_courses','error','system'));
								break;
			case 'all_courses':
								$courses=utils\course\all_courses();
								if($courses!=-1)
									echo(utils\reply('all_courses','success',$courses));
								else
									echo(utils\reply('all_courses','error','system'));
								break;
			case 'add_courses':
								$courses=$data['courses'];
								$institute=$data['institute'];
								if(utils\course\add_courses($institute,$courses)!=-1)
									echo(utils\reply('add_courses','success','courses_added'));
								else
									echo(utils\reply('add_courses','error','already_added'));
								break;
			case 'delete_courses':
								$courses=$data['courses'];
								$institute=$data['institute'];
								if(utils\course\delete_courses($institute,$courses)!=-1)
									echo(utils\reply('delete_courses','success','courses_deleted'));
								else
									echo(utils\reply('delete_courses','error','already_deleted'));
								break;
			case 'add_subjects':
								$course=$data['course'];
								$subjects=$data['subjects'];
								if(utils\course\add_subjects($course,$subjects)!=-1)
									echo(utils\reply('add_subjects','success','subjects_added'));
								else
									echo(utils\reply('add_subjects','error','system_error'));
								break;
			case 'delete_subjects':
								$course=$data['course'];
								$subjects=$data['subjects'];
								if(utils\course\delete_subjects($course,$subjects)!=-1)
									echo(utils\reply('delete_subjects','success','deleted'));
								else
									echo(utils\reply('delete_subjects','error','system_error'));
								break;
			case 'edit_subjects':
								$course=$data['course'];
								$subjects=$data['subjects'];
								if(utils\course\edit_subjects($course,$subjects)!=-1)
									echo(utils\reply('edit_subjects','success','edited'));
								else
									echo(utils\reply('edit_subjects','error','system_error'));
								break;
			case 'get_subjects':$subjects=utils\course\get_subjects($_POST['value']);
								if($subjects!=-1)
									echo(utils\reply('get_subjects','success',$subjects));
								else
									echo(utils\reply('get_subjects','error','system'));
								break;
			case 'get_semesters':$institute=$data['institute'];
								$course=$data['course'];
								$sem=utils\course\get_semester();
								if($sem!=-1)
									echo(utils\reply('get_semesters','success',$sem));
								else
									echo(utils\reply('get_semesters','error','system'));
								break;
			default: echo(utils\reply('list','error','badrequest'));
			

								

		}	
	}
	else
	{
		echo(utils\reply('user','error','badrequest'));
	}
	
}
?>
