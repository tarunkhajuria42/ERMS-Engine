<?php
namespace data;
function lists()
{
	if(isset($_POST['request']))
	{
		if(isset($_POST['data']))
			$data=json_decode($_POST['data'],true);
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
