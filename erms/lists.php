<?php
namespace data;
function user()
{
	if(isset($_POST['request']))
	{
		if(isset($_POST['data']))
		{
			$data=json_decode($_POST['data'],true);
		}
		switch($_POST['request'])
		{
			

		}	
	}
	else
	{
		echo(utils\reply('user','error','badrequest'));
	}
	
}
?>
