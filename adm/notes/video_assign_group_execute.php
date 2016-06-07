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

$field_count=$_POST['field_count'];

$rank_id=$_POST['rank'];
$class_name=$_POST['class_name'];
$the_video_id=$_POST['video_id'];

/*for($i=1; $i<=$field_count; $i++)
{
	if(isset($_POST['chkbox_' .$i]))
	{
	$tempVal = $_POST['chkbox_' . $i];
	$jorja="select * from video_assign where video_id = '$_POST[video_id]' AND student_id='$tempVal'";
	$jorja_query = mysqli_query($cxn, $jorja)
	or die("Couldn't execute query.");
	$jorja_count = mysqli_num_rows($jorja_query);
		if(!$jorja_count>0)
		{
		$vivian = "INSERT into video_assign (student_id, video_id) values ('$tempVal', '$_POST[video_id]')";
		$insertexe = mysqli_query($cxn, $vivian);
			if(!$insertexe) {
			$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
			die($error);
			}
		}
	}
	if(!isset($_POST['chkbox_' .$i]))
	{
	$vivian = "delete from video_assign where student_id='$tempVal' and video_id='$_POST[video_id]'";
	echo $vivian;
		$insertexe = mysqli_query($cxn, $vivian);
		if(!$insertexe) {
		$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
		die($error);
		}
	}
}*/
$scott="select s.first_name, s.last_name, s.id, s.rank, c.name, r.rank as belt_name from students s 
LEFT OUTER JOIN classes c on (s.class=c.name or s.class_two=c.name) 
INNER JOIN ranks r on r.id = s.rank
where (s.rank = '$rank_id' or s.rank_two='$rank_id') and (s.class='$class_name' or s.class_two='$class_name')
order by s.last_name";
$scott_query=mysqli_query($cxn, $scott);
	if(!$scott_query)
	{
	$drag=mysqli_errno($cxn).': '.mysqli_error($cxn);
	die($drag);
	}
while($scott_row=mysqli_fetch_assoc($scott_query))
{
extract($scott_row);

if(isset($_POST['chkbox_' .$scott_row['id']]))
	{
	$tempVal = $_POST['chkbox_' . $scott_row['id']];
	$jorja="select * from video_assign where video_id = '$_POST[video_id]' AND student_id='$tempVal'";
	$jorja_query = mysqli_query($cxn, $jorja)
	or die("Couldn't execute query.");
	$jorja_count = mysqli_num_rows($jorja_query);
		if(!$jorja_count>0)
		{
		$vivian = "INSERT into video_assign (student_id, video_id) values ('$tempVal', '$_POST[video_id]')";
		$insertexe = mysqli_query($cxn, $vivian);
			if(!$insertexe) {
			$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
			die($error);
			}
		}
	}
	if(!isset($_POST['chkbox_' .$scott_row['id']]))
	{
	$vivian = "delete from video_assign where student_id='$scott_row[id]' and video_id='$_POST[video_id]'";
		$insertexe = mysqli_query($cxn, $vivian);
		if(!$insertexe) {
		$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
		die($error);
		}
	}
}
header("Location:video_assign_group_return.php?rank_id=$rank_id&class_name=$class_name&video_id=$the_video_id");
exit();
?>
            