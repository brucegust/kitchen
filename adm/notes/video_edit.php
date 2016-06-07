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

$the_video_code=trim($_POST['video_code']);


$headline = mysqli_real_escape_string($cxn, trim($_POST['name']));
$age = mysqli_real_escape_string($cxn, trim($_POST['age']));
$the_belt = $_POST['belt'];
$bigstory = mysqli_real_escape_string($cxn, trim($_POST['description']));
$video_code = htmlspecialchars("$the_video_code", ENT_QUOTES);
$class_name =trim($_POST['class']);

$query = "UPDATE videos SET name='$headline',
description='$bigstory', 
video_code='$video_code',
class_name='$class_name', 
age='$age',
belt='$the_belt'
where id = '$_POST[ID]'";
$result = mysqli_query($cxn, $query);

if(!$result) {
$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
die($error);
} 	

require_once('header.php');
 
?>

	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
		<tr>
		<td>
		<td>
		<IMG SRC="../images/spacer.gif" width="10" height="10">
		</td>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" width=100%>
			<tr>
			<td class="TitleText">
			<b>Video Display Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the video you just edited. To make any addtional changes, click on the "Back" button of your browser and repeat the process. Otherwise, to return to the Video List, click <A HREF="video_list.php">here</a>.
			<P>
			<?php include ("help.php"); ?>
			</td>
			</tr>
			<tr>
			<td>
			&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td>
			<HR>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td align="center">
					<table width="700" align="center" border="1">
					<tr>
					<td bgcolor="#cccccc">
					<b>Name:</b>
					</td>
					<td background="../images/spacer.gif" width="550" height="10">
					<?php echo "$_POST[name]"; ?>
					</td>
					</tr>
					<tr>
					<td bgcolor="#cccccc">
					<b>Class:</b>
					</td>
					<td>
					<?php echo $_POST['class']; ?>
					</td>
					</tr>
					<tr>
					<td bgcolor="#cccccc">
					<b>Age:</b>
					</td>
					<td>
					<?php echo $_POST['age']; ?>
					</td>
					</tr>
					<tr>
					<td bgcolor="#cccccc">
					<b>Belt:</b>
					</td>
					<td>
					<?php
					$bruce="select * from ranks where id='$_POST[belt]'";
					$bruce_query=mysqli_query($cxn, $bruce)
					or die("Couldn't execute Bruce.");
					$bruce_row=mysqli_fetch_assoc($bruce_query);
					extract($bruce_row);
					echo stripslashes($bruce_row['rank']); ?>
					</td>
					</tr>
					<tr>
					<td bgcolor="#cccccc" colspan="2">
					<b>Video Code:</b>
					</td>
					</tr>
					<tr>
					<td colspan="2" background="../images/spacer.gif" width="700" height="10">
					<?php 
					echo stripslashes($video_code);
					?>
					</td>
					</tr>
					<tr>
					<td colspan="2" bgcolor="#cccccc" background="../images/spacer.gif" width="700" height="10">
					<b>Description:</b>
					</td>
					</tr>
					<tr>
					<td colspan="2" background="../images/spacer.gif" width="700" height="10">
					<?php 
					$textarea = stripslashes(str_replace("\n","<br>",$_POST['description']));
					echo "$textarea";
					?>
					</td>
					</tr>
					</table>
				</td>
				<td>
				<IMG SRC="../images/spacer.gif" width="10" height="10">
				</td>
				</tr>
				</table>
			
		</td>
		<td>
		<IMG SRC="../images/spacer.gif" width="10" height="10">
		</td>
		</tr>
		</table>

 <?php require_once('footer.php'); ?>	
		
