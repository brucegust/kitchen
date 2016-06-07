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
			<b>Video Assign Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Below is the list of all the students in the database. Click on the name of the student and then you'll be able to assign the video(s) that they're qualified to view.
			<P>
			<div align="center"><b>You have one of two ways that you can assign a video. You can use this page and do it individually, or you can click <A HREF="video_assign_group.php">here</a>, and assign a video to a group of students based on belt and class.</b></div>
			<br><br>
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
			<td align="center" background="../images/spacer.gif" width="700" height="10">
				<table width=100% border="1" cellspacing="3" cellpadding="3">
				<tr>
				<td style="background-color:#000000; color:#ffffff;">
				Last Name
				</td>
				<td style="background-color:#000000; color:#ffffff;">
				First Name
				</td>
				<td style="background-color:#000000; color:#ffffff;">
				Select
				</td>
				</tr>
				<?php
				$cur_classname="";
				$querystate = "select s.id, s.first_name, s.last_name, c.name, c.sort_order from students s LEFT OUTER JOIN classes c on s.class=c.name order by c.sort_order, s.last_name";
				$michelle_query=mysqli_query($cxn, $querystate)
				or die("Couldnt' do Michelle!");
				while($michelle_row=mysqli_fetch_assoc($michelle_query))
				{
				extract($michelle_row);
				?>
				<?php
				if($cur_classname<>$michelle_row['name'])
				{
				?>
				<tr>
				<td colspan="3" bgcolor="#cccccc">
				<?php echo stripslashes($michelle_row['name']); ?>
				</td>
				</tr>
				<?php
				}
				?>
				<tr>
				<td>
				<?php echo stripslashes($michelle_row['last_name']); ?>
				</td>
				<td>
				<?php echo stripslashes($michelle_row['first_name']); ?>	
				</td>
				<td style="text-align:center;">
				<A HREF="video_assign_board.php?student_id=<?php echo $michelle_row['id']; ?>">select</a>
				</td>
				</tr>
				<?php
				$cur_classname=$michelle_row['name'];
				}
				?>
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

