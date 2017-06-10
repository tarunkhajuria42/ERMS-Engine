<?php
/* Error utitlity
Error code definiton for API

tarunkhajuria42@gmail.com

*/
namespace data\utils;
function reply($module,$reply)
{
	$result['module']=$module;
	$result['type']=$type;
	$result['reply']=$reply;
	return json_encode($result);
		
}

?>