<?php 
session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
$today = date("Y-m-d");
$the_student_id=$_POST['student_id'];
include ("../carter.inc");
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$query = "select * from videos order by id";
$query_go = mysqli_query($cxn, $query)
or die("Couldn't execute query.");
while($row=mysqli_fetch_assoc($query_go))
{
	if(isset($_POST['chkbox_' . $row['id'] ]))
	{
	$tempVal = $_POST['chkbox_' . $row['id']];
	$jorja="select * from video_assign where video_id = '$tempVal' AND student_id='$the_student_id'";
	$jorja_query = mysqli_query($cxn, $jorja)
	or die("Couldn't execute query.");
	$jorja_count = mysqli_num_rows($jorja_query);
		if(!$jorja_count>0)
		{
		$vivian = "INSERT into video_assign (student_id, video_id) values ('$the_student_id', '$row[id]')";
		$insertexe = mysqli_query($cxn, $vivian);
			if(!$insertexe) {
			$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
			die($error);
			}
		}	
	}
}

//this is where I look to see if there is a record in the transcript table that corresponds to a student whose box is not checked. In other words, the administrator has unchecked a box
//in order to delete their record from the transcript for this particular class
$bruce="select * from video_assign where student_id = '$the_student_id'";
$bruce_query=mysqli_query($cxn,$bruce)
or die("Couldn't execute query.");
while($bruce_row = mysqli_fetch_assoc($bruce_query))
{
extract($bruce_row);
$the_video_id = $bruce_row['video_id'];
	if(!isset($_POST['chkbox_' . $the_video_id ])){
	//there's a record in the video_assign table, but the appropriate checkbox isn't checked, so we need to delete that record from the database
	$brenda="delete from video_assign where student_id='$the_student_id' AND video_id='$the_video_id'";
	$brenda_query = mysqli_query($cxn,$brenda)
	or die("Couldn't execute query.");
	}
}		
header("Location:video_assign_board.php?student_id=$the_student_id");
?>
            