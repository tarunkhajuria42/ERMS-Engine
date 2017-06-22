<?php
namespace data;
function lists()
{
	if(isset($_POST['request']))
	{
		if(isset($_POST['data']))
		{
			echo($_POST['data']);
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
									echo(utils\reply('list','success',$institutes));	
								}
								else
									echo(utils\reply('list','error','system'));
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
									echo(utils\reply('list','success',$courses));
								}
								else
									echo(utils\reply('list','error','system'));
								break;
			case 'all_courses':
								$courses=utils\course\all_courses();
								if(cor!=-1)
									echo(utils\reply('list','success',$courses));
								else
									echo(utils\reply('list','error','system'));
								break;
			case 'add_courses':
								$courses=$data['courses'];
								$institute=$data['institute'];
								if(utils\course\add_courses($institute,$course)!=-1)
									utils\reply('list','success','courses_added');
								else
									utils\reply('list','error','already_added');
								break;
			case 'delete_courses':
								$courses=$data['courses'];
								$institute=$data['institute'];
								if(utils\course\delete_courses($institute,$course)!=-1)
									utils\reply('list','success','courses_added');
								else
									utils\reply('list','error','already_added');
								break;
			case 'add_subjects':
			default: echo(utils\reply('list','error','badrequest'));
			

								

		}	
	}
	else
	{
		echo(utils\reply('user','error','badrequest'));
	}
	
}
?>
