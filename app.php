<?php
require "./xmlandJson.php";
$data=array(
	'id'=>1,
	'name'=>'tom',
	'type'=>array(4,5,6),
	'test'=>array(1,45,67=>array(123,'test'),),
);

Response::show('200','success',$data);
?>