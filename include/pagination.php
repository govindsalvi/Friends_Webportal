<?php
class Pagination
{
    public $current_page;
    public $per_page;
    public $total_count;
    function __construct($current_page=1,$per_page=10,$total_count=10)
    {
    //echo $total_count;
    $this->current_page=(int)$current_page;
    $this->per_page=(int)$per_page;
    $this->total_count=(int)$total_count;
    //echo $this->total_count;
        
    }
public function offset()
{
    
    return(($this->current_page-1)*$this->per_page);
    
}
public function total_pages()
{
    //echo $this->total_count;
    $total=ceil($this->total_count/$this->per_page);
    return $total;
}
public function privious_page()
{
    return $this->current_page-1;
}
public function next_page()
{
    return $this->current_page+1;
}
public function has_next_page()
{
    return $this->next_page()<=$this->total_pages()? true:false;
    //return $this->next_page() < $this->total_pages()? true :flase;
}
function has_privious_page(){
    return $this->privious_page()>=1?true:false;
}

}

?>