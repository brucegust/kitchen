<?php 
session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
$today = date("Y-m-d");
include ("../carter.inc");
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$query = "select * from students order by id";
$query_go = mysqli_query($cxn, $query)
or die("Couldn't execute query.");
while($row=mysqli_fetch_assoc($query_go))
{
	if(isset($_POST['chkbox_' . $row['id'] ]))
	{
	$tempVal = $_POST['chkbox_' . $row['id']];
	$jorja="select * from students where id = '$tempVal' AND rank='$_POST[rank]'";
	$jorja_query = mysqli_query($cxn, $jorja)
	or die("Couldn't execute query.");
	$jorja_count = mysqli_num_rows($jorja_query);
		if(!$jorja_count>0)
		{
		$vivian = "update students set rank=$_POST[rank] where id=$tempVal";
		$insertexe = mysqli_query($cxn, $vivian);
			if(!$insertexe) {
			$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
			die($error);
			}
		}	
	}
}

/*
//this is where I look to see if there is a record in the transcript table that corresponds to a student whose box is not checked. In other words, the administrator has unchecked a box
//in order to delete their record from the transcript for this particular class
$bruce="select * from students order by id";
$bruce_query=mysqli_query($cxn,$bruce)
or die("Couldn't execute query.");
while($bruce_row = mysqli_fetch_assoc($bruce_query))
{
extract($bruce_row);
	if(!isset($_POST['chkbox_' . $bruce_row['id'] ]))
	{
	//there's a record in the video_assign table, but the appropriate checkbox isn't checked, so we need to delete that record from the database
	$brenda="update students set rank=$_POST[current_rank] where id=$bruce_row[id]";
	$brenda_query = mysqli_query($cxn,$brenda)
	or die("Couldn't execute query.");
	}
}	
*/
$the_rank=$_POST['rank'];
$the_class_name=$_POST['class_name'];	
header("Location:student_promote_board.php?rank_id=$the_rank&class_name=$the_class_name");
?>
            