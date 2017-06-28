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


function initConnection()
{
	try{
	$conn=new \PDO("mysql:host=$GLOBALS[servername];dbname=$GLOBALS[dbname]",$GLOBALS['username'],$GLOBALS['password']);
	$conn->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
	return $conn;
	}catch(\Exception $e)
	{
		echo "Exception Caught", $e->getMessage(),"\n";
	}
}

function initConnectionCurrent()
{	
	try{
		$conn=new \PDO("mysql:host=$GLOBALS[servername];dbname=$GLOBALS[dDbname]",$GLOBALS['dUsername'],$GLOBALS['dpassword']);
		$conn->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
		return $conn;
	}
	catch(\Exception $e)
	{
		echo "Exception Caught", $e->getMessage(),"\n";
	}
}
/* Table 1=Erms
	Table 2='ErmsCurrent'*/

function insert($query,$parameters,$table)
{
	if($table==1)
	{
		$conn=initConnection();	
	}else{
		$conn=initConnectionCurrent();
	}
	
	try{
		$statement=$conn->prepare($query);
		$variables=count($parameters);
		for ($i=0;$i<$variables;$i++)
		{
			$statement->bindParam($i+1,$parameters[$i]);
		}
			
		$statement->execute();
		return 1;
	}catch(\Exception $e)
	{
		return -1;
	}
}
function update($query,$parameters,$table)
{
	if($table==1)
	{
		$conn=initConnection();	
	}else{
		$conn=initConnectionCurrent();
	}
	
	try{
		$statement=$conn->prepare($query);
		$variables=count($parameters);
		for ($i=0;$i<$variables;$i++)
		{
			$statement->bindParam($i+1,$parameters[$i]);
		}
			
		$statement->execute();
		return 1;
	}catch(\Exception $e)
	{
		return -1;
	}
}
function find($query,$parameters,$table)
{
	if($table==1)
	{
		$conn=initConnection();	
	}
	else
	{
		$conn=initConnectionCurrent();		
	}
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

	}catch(\Exception $e)
	{
		return -1;
		echo "Exception found",$e->getMessage(),"\n";	
	}
	
}
function delete($query,$parameters,$table)
{
	if($table==1)
		$conn=initConnection();
	else
		$conn=initConnectionCurrent();
	try{
		$statement=$conn->prepare($query);
		$variables=count($parameters);
		for ($i=0;$i<$variables;$i++)
		{
			$statement->bindParam($i+1,$parameters[$i]);
		}
			
		$statement->execute();
	}catch(\Exception $e)
	{
		return -1;
		echo "Ecteption found",$e->getMessage(),"\n";	
	}
}

?>