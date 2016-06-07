<?php
 
session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
 
include ("../carter.inc");
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");


//insert data into database, followed by entering picture according to id of new staff member

$target = "../assets/images/2010CabinetImages/"; 
$target = $target . basename( $_FILES['image']['name']) ;
$url = basename($_FILES['image']['name']); 
$ok=1; 
	if ($uploaded_type =="text/php")
	{
	$ok=0;
	} 
//Here we check that $ok was not set to 0 by an error 
	if ($ok==0) 
	{ 
	header("Location: photo_badfile.php");
	} 
	 
if(!move_uploaded_file($_FILES['image']['tmp_name'], $target)) 
{	
	header("Location: photo_noupload.php");
	exit();
}
else 
{
  	$michelle = "update categories set image_path='$url' where id = '$_POST[ID]'";
	$michelle_query=mysqli_query($cxn, $michelle);
		if(!michelle_query)
		{
		$whoops = mysqli_errno($cxn).' '.mysqli_error($cxn);
		die($whoops);
		}
}
 
 

?>

