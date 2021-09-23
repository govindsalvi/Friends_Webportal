<?php
require_once("database.php");
require_once("session.php");
require_once("coments.php");
require_once("function.php");
class Photographs
{
protected static $table="photographs";
protected static $db_fields=array('id','user_id','filename','type','size','caption');
public $id;
public $user_id;
public $filename;
public $type;
public $size;
public $caption;
public $when1;
private $tamp_path;
protected $upload_dir="images";
public $errors=array();
private $upload_errors=
    array(
        UPLOAD_ERR_OK       =>"No Errors",
        UPLOAD_ERR_INI_SIZE=>"Larger than maximum file size",
        UPLOAD_ERR_FORM_SIZE=>"Larger than maximum file size",
        UPLOAD_ERR_PARTIAL=>"Partial Upload",
        UPLOAD_ERR_NO_FILE=>"No File",
        UPLOAD_ERR_NO_TMP_DIR=>"No temp directory",
        UPLOAD_ERR_CANT_WRITE=>"Can't Write",
        UPLOAD_ERR_EXTENSION=>"File Upload stoped by extention"
    );
public function sizetext()
    {
    $size;
    $curr_size=$this->size;
    if($curr_size<1024)
    return $curr_size."Bytes";
    else if ($curr_size<1048576){
    $size=round($curr_size/1024);
    return $size."KB";    
    }
    else
    {
        $size=round($curr_size,1);
        return $size."MB";
    }
    
    return size;
    }   
public function attach_file($file)
    {
        //echo "hello";
    if(empty($file)||!is_array($file))
    { $this->errors[]="No file was uploaded";return false;}
    else if($file['error']!=0)
            {   //echo "hello";
                $this->errors[]=$this->upload_errors[$file['error']];
                return false;
                }
    else {
        //echo $file['name'];
        $this->filename=$file['name'];
        $this->tamp_path=$file['tmp_name'];
        $this->type=$file['type'];
        $this->size=$file['size'];
        $this->user_id=$_SESSION['user_id'];
        //$this->caption=$file['caption'];
        //echo $this->filename."na";
        //echo $this->filename."<br/>";
        //echo $this->type."<br/>";
        //echo $this->tamp_path."<br/>";
        //echo $this->size."<br/>";
        return true;
        }
    
    }

public function give_time()
{
    global $database;
    $sql="SELECT when1 FROM photographs WHERE id={$this->id} LIMIT 1";
    //echo $sql;
    $result = $database->query($sql);
    $row=$database->fetch_array($result);
    //if(is_array($row))
    //{
      //  echo "hello";
    //}
    //else echo "not";
    //$row=$database->fetch_array($result);
    return array_shift($row);
    return ($result);

}

public function save()
    {
        //echo $this->tamp_path;
        if(isset($this->id)){
            $this->update();
        }
        else{
                        if(!empty($this->errors)){
                            return false;
                        }
                        if(strlen($this->caption)>255){
                        $this->errors[]="The caption can only be 255 car";
                        return false;
                        }
                    if(move_uploaded_file($this->tamp_path,"../images/{$this->filename}"))
                    {
                        //echo $this->tamp_path;
                        $this->create();
                        return true;
                    }
                    else{
                        //echo $this->tamp_path."hhhh";
                        $this->errors[]="File upload faileld";
                        return false;
                        }
            
                        
            }
        
    }
public static function find_by_userid($userid)
{
    $sql="SELECT * from ".self::$table." WHERE user_id={$userid}";
    $object_array = self::find_by_sql($sql);
    return $object_array;
    
}
public function allcomment()
{
    return Coments::find_by_photoid($this->id);
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
public static function count_all()
{
    global $database;
    $sql="SELECT count(*) FROM ".self::$table;
    //echo $sql;
    $result = $database->query($sql);
    $row=$database->fetch_array($result);
    //if(is_array($row))
    //{
      //  echo "hello";
    //}
    //else echo "not";
    //$row=$database->fetch_array($result);
    return array_shift($row);
    return ($result);
}
public static function count_all_by_user($user_id)
{
    global $database;
    $sql="SELECT count(*) FROM ".self::$table." WHERE user_id={$user_id}";
    //echo $sql;
    $result = $database->query($sql);
    $row=$database->fetch_array($result);
    //if(is_array($row))
    //{
      //  echo "hello";
    //}
    //else echo "not";
    //$row=$database->fetch_array($result);
    return array_shift($row);
    return ($result);
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
}public static function find_by_sql($sql)
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
        echo $attribute_pairs[1];
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
	return true;
	//echo $sql."<br/>";
	//echo "deleted"."<br/>";
	}
	else
	return false;
	//echo "failed";
	}
 //we are overloading this method       
//public function save()
  //  {
    //return isset($this->id)?$this->update():$this->create();
    //}
}

?>