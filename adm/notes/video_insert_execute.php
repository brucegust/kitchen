<?php
 
session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
 
include ("../carter.inc");

$the_video_code = trim($_POST['video_code']); 

$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$headline = mysqli_real_escape_string($cxn, trim($_POST['name']));
$age = mysqli_real_escape_string($cxn, trim($_POST['age']));
$the_belt = $_POST['belt'];
$bigstory = mysqli_real_escape_string($cxn, trim($_POST['description']));
$video_code = htmlspecialchars("$the_video_code", ENT_QUOTES);
$class_name =trim($_POST['class']);
$insert = "insert into videos (name, description, class_name, video_code, age, belt)
values ('$headline', '$bigstory', '$class_name', '$video_code', '$age', '$the_belt')";
$insertexe = mysqli_query($cxn, $insert);
if(!$insertexe) {
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
			<b>Video Insert Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the video you just entered into the database. To make any changes, click <A HREF="video_list.php">here</a>, or to add another video, click <A HREF="video_insert.php">here</a>.
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
				<table width=100% border="0">
				<tr>
				<td>
				<IMG SRC="../images/spacer.gif" width="10" height="10">
				</td>
				<td align="center">	
					<table width="700" align="center" border="1">
					
					<tr>
					
					<td bgcolor="#CCCCCC">
					<b>Name:</b>
					</td>
					<td background="../images/spacer.gif" width="550" height="10">
					<?php echo "$_POST[name]"; ?>
					</td>
					</tr>
					<tr>
					<td bgcolor="#CCCCCC">
					<b>Class:</b>
					</td>
					<td background="../images/spacer.gif" width="550" height="10">
					<?php echo "$_POST[class]"; ?>
					</td>
					</tr>
					<tr>
					<td bgcolor="#CCCCCC">
					<b>Age:</b>
					</td>
					<td background="../images/spacer.gif" width="550" height="10">
					<?php echo "$_POST[age]"; ?>
					</td>
					</tr>
					<tr>
					<td bgcolor="#CCCCCC">
					<b>Belt:</b>
					</td>
					<td background="../images/spacer.gif" width="550" height="10">
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
					<td colspan="2" bgcolor="#CCCCCC">
					<b>Video Code:</b>
					</td>
					</tr>
					<tr>
					<td colspan="2">
					<?php 
					echo stripslashes($video_code);
					?>
					</td>
					</tr>
					<tr>
					<td colspan="2" bgcolor="#CCCCCC">
					<b>Description:</b>
					</td>
					</tr>
					<tr>
					<td colspan="2">
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
			</tr>
			</table>
		</td>
		
		<td>
		<IMG SRC="../images/spacer.gif" width="10" height="10">
		</td>
		</tr>
		</table>
 <?php require_once('footer.php'); ?>	
		