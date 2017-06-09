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
	return $result;
		case 0:	
		case 1:
				$result['type']='error';
				$result['code']='1';
				$result['message']='no token';
				return $result;
		case 2: 
				$result['type']='error';
				$result['code']='2';
				$result['message']='invalid token';
				return $result;
		case 3: $result['type']='error';
				$result['code']='3';
				$result['message']='token expired';
				return $result;
		default:
				return -1;
	}
}

?>