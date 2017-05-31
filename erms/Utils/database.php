<?php
/* 
Exam Mangement System

Author:Tarun Khajuria(tarunkhajuria42@gmail.com)
Version 0.1
2017
*/

//Main Database interaction
namespace data\utils\database;
require ("configuration.php");


function init_connection()
{
	try{
	echo $GLOBALS['servername'];
	$conn=new \PDO("mysql:host=$GLOBALS[servername];dbname=$GLOBALS[dbname]",$GLOBALS['username'],$GLOBALS['password']);
	$conn->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
	return $conn;
	}
	catch(Exception $e)
	{
		echo "Exception Caught", $e->getMessage(),"\n";
	}

}
function insert($query,$parameters)
{
	$conn=init_connection();
	try{
		$statement=$conn->prepare($query);
		$variables=count($parameters);
		for ($i=0;$i<$variables;$i++)
		{
			$statement->bindParam($i+1,$parameters[$i]);
		}
			
		$statement->execute();
	}catch(Exception $e)
	{
		echo "Ecteption found",$e->getMessage(),"\n";	
	}
}
function find($query,$parameters)
{
	$conn=init_connection();
	try{
		$statement=$conn->prepare($query);
		$variables=count($parameters);
		for ($i=0;$i<$variables;$i++)
		{
			$statement->bindParam($i+1,$parameters[$i]);
		}
		$statement->execute();
		$res=[];
		for($i=0; $i<$statement->rowCount();$i++)
		{
			$res[$i]=$statement->fetch();
		}
		return $res;

	}catch(Exception $e)
	{
		echo "Exception found",$e->getMessage(),"\n";	
	}
	
}

?>