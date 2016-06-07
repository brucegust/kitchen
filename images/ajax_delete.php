<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include("carter.inc");
$mysqli = new mysqli($host,$user,$password,$database);
if($mysqli->connect_errno)
{
	$err="CONNECT FAIL: "
	.$mysqli->connect_errno
	. ' '
	.$mysqli->connect_error
	;
	trigger_error($err, E_USER_ERROR);
}

function delete_cart() {
	
	$result="";
	
	global $mysqli;
	
	$the_product_id=$_POST['delete_product_id'];
	$the_session_id=$_POST['delete_session_id'];
	
	$sql="delete from cart where session_id='$the_session_id' and product_id='$the_product_id'";
	if(!$query=$mysqli->query($sql))
	{
		$result="fail";
	}
	else
	{
		$result="success";
	}
	
	return $result;
}

$kill_it=delete_cart();

echo $kill_it;

?>