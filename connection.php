<?php 

$con= mysql_connect("localhost","umer","kingumer");

$db =mysql_select_db('prototype',$con);

if (!$db) {
echo  'error';

} 


?>