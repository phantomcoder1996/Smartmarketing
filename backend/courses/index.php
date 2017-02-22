<?php
include '../../dbconnection.php';

class course implements JsonSerializable
{
private $name;
private $ID;
private $duration;
private $objectives=array();
private $audience=array();


//public
public function setname($n)
{
	$this->name=$n;
}
public function setID($ID1)
{
	$this->ID=$ID1;
}
public function setduration($d)
{
	$this->duration=$d;
}
public function addobjective($obj)
{
	$this->objectives[]=$obj;
}
public function addaudience($a)
{
	$this->audience[]=$a;
}

public function getID()
{
	return $this->ID;
}

public function jsonSerialize()
{
return ['name'=>$this->name,'ID'=>$this->ID,'duration'=>$this->duration,'objectives'=>$this->objectives,'audience'=>$this->audience];
}
}

//now create a query to get course info from data base




$coursesarr[]=array();

$course_info="SELECT * FROM COURSES";//RETRIEVE ALL COURSES
$course_info_res=$conn->query($course_info);
$row_count=$course_info_res->num_rows;
if($row_count>0)
{
	//create a new course and fill its data
	//add that course to courses arr
	for($i=0;$i<$row_count;$i++)
	{
		$row=$course_info_res->fetch_assoc();
		$cid=$row['id'];
		$c=new course();
		$c->setname($row['name']);
        $c->setID($cid);
        $c->setduration($row['duration']);
        //query course objectives
        $course_obj="SELECT objective FROM COURSES_OBJECTIVES WHERE ID=$cid";
        $course_obj_res=$conn->query($course_obj);
        $count=$course_obj_res->num_rows;
        for($j=0;$j<$count;$j++)
        {
        	$row=$course_obj_res->fetch_assoc();
        	$c->addobjective($row['objective']);
        }
        //query course audience
        $course_aud="SELECT audience FROM COURSES_AUDIENCE WHERE ID=$cid";
        $course_aud_res=$conn->query($course_aud);
        $count=$course_aud_res->num_rows;
        for($k=0;$k<$count;$k++)
        {
        	$row=$course_aud_res->fetch_assoc();
        	$c->addaudience($row['audience']);
        }       
      $coursesarr[$i]=$c;
	}
}






$json=json_encode($coursesarr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK );


echo $json;



?>