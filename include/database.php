<?php
require_once("config.php");

class Database
{
private $link;

function __construct()
	{
		$this->link=mysql_connect(HOST,USER,PASS);
		if($this->link)
		{
			if(mysql_select_db(DATABASE,$this->link))
				{
		
				}
			else
			{
			echo mysql_error();
			}
		}
		else
			{
			echo mysql_error();
			}
	}

public function fetch_array($result_set)
	{
		return mysql_fetch_array($result_set);
	}
public function insert_id()
	{
		return mysql_insert_id();
	}
public function affected_rows()
	{
		return mysql_affected_rows($this->link);
	}

public function query($sql)
	{
		$result=mysql_query($sql);
		if($result)
		{
		return $result;
		}
		else
			{
			echo mysql_error();
			}
	}
public function work_on_slash($input)
		{
				$magic_quotes_active=get_magic_quotes_gpc();
				$newverson=function_exists("mysql_real_escape_string");
				if($newverson)
					{
					if($magic_quotes_active)
					$input=stripcslashes($input);
					$input=mysql_real_escape_string($input);
					}
				else
				{
					if(!$magic_quotes_active)
					$input=addcslashes($input);
				}
				return $input;
		}

}

$database = new Database();
?>