<?php
/* Error utitlity
Error code definiton for API

tarunkhajuria42@gmail.com

*/
namespace data\utils;
function error($code)
{
	switch($code){
		case 0:	$result['type']='error';
				$result['code']='0';
				$result['message']='bad request';
				return $result;
		case 1:
				$result['type']='error';
				$result['code']='1';
				$result['message']='no token';
				return $result;
		default:
				return -1;
	}
}

?>