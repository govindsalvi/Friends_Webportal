<?php
require_once("database.php");
class User
{
protected static $table="user";
protected static $db_fields=array('id','username','password','profilepic','theme');
public $id;
public $username;
public $password;
public $profilepic="profilepic.jpg";
public $theme="main.css";














public static function authonticate($username="",$password="")
{
    global $database;
    $sql="SELECT * FROM user WHERE username='{$username}' AND password='{$password}' LIMIT 1";
    $found=self::find_by_sql($sql);
    return !empty($found) ? array_shift($found) : false;    
}
//methods common to all classes
private function has_attribute($attritube)
    {
       $allattribute=$this->attribute();
       if(array_key_exists($attritube,$allattribute))
       return true;
       return false;
    }
protected function attribute()
    {
        $attributes=array();
        foreach(self::$db_fields as $field)
        if(property_exists($this,$field))
        $attributes[$field]=$this->$field;
        return $attributes;
    }
protected function get_clean_attribute()
    {
        global $database;
        $clean_attribute=array();
        //$raw_attribute=$this->attribute();
        foreach($this->attribute() as $key=>$value)
        $clean_attribute[$key]=$database->work_on_slash($value);
        return $clean_attribute;
    }
public static function find_by_primary_key($key)
    {
        global $database ;
        $sql="select * from ".self::$table." where username='{$key}' LIMIT 1";
	$object_array = self::find_by_sql($sql);
	return array_shift($object_array);
       
    }

public static function find_by_id($id)
    {
        global $database ;
        $sql="select * from ".self::$table." where id={$id} LIMIT 1";
	$object_array = self::find_by_sql($sql);
	return array_shift($object_array);
       
    }
public static function find_all()
{
    $sql="SELECT * FROM ".self::$table;
    $object_array = self::find_by_sql($sql);
    return $object_array;
}
private static function create_object($row)
{
        $object = new self;
	//$object->id=$row['id'];
	//$object->username=$row['username'];
	//$object->password=$row['password'];
        
        foreach($row as $key=>$value){
            if($object->has_attribute($key)){
                $object->$key=$value;
            }
            
        }
        
        //echo $object->username;
	return $object;
}
public static function find_by_sql($sql)
{
    global $database ;
    $result =   $database->query($sql);
    $object_array= array();
    while($row=$database->fetch_array($result))
    $object_array[]=self::create_object($row);
    return $object_array;
}
private function update()
{
    	global $database;
        $attribute=$this->get_clean_attribute();
        $attribute_pairs=array();
        foreach($attribute as $key=>$value)
        $attribute_pairs[]="{$key}='{$value}'";
        //print_r($attribute_pairs);
        //echo $attribute_pairs[1];
	$sql = "UPDATE ".self::$table." SET ".join(", ",$attribute_pairs)." WHERE id={$this->id}";
	//$sql. = " ('{$this->username}','{$this->password}')";
	$database->query($sql);
	if($database->affected_rows()==1)
        return true;
        return false;
    
	
}
private function create()
	{
            
	global $database;
        $attribute=$this->get_clean_attribute();
        
	$sql = "INSERT INTO ".self::$table." (".join(",",array_keys($attribute)).") values ('".join("', '",array_values($attribute))."')";
        //echo $sql;
	//$sql. = " ('{$this->username}','{$this->password}')";
	if($database->query($sql))
	{
        $this->id=$database->insert_id();
	return true;
	}
	else
	return false;
		
	}
public function delete()
	{
	global $database;
	$sql="DELETE FROM ".self::$table." WHERE id={$this->id} LIMIT 1";
	if($database->query($sql))
	{
	echo $sql."<br/>";
	echo "deleted"."<br/>";
	}
	else
	echo "failed";
	}
public function save()
    {
    return isset($this->id)?$this->update():$this->create();
    }
}
?>