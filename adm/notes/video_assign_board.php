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
			Below is the name of the student that you just selected. Their password, by default, is "Secret." 
			<br><br>
			Put a check beside the video(s) that they're paying for / qualified to view and click on the "update" button at the bottom of the page.
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
			<td>
			<?php
				$vivian="select * from students where id='$_GET[student_id]'";
				$vivian_query=mysqli_query($cxn, $vivian)
				or die("Couldn't make Vivian happy.");
				$vivian_row=mysqli_fetch_assoc($vivian_query);
				extract($vivian_row);
				?>
				<A HREF="student_display.php?ID=<?php echo $vivian_row['id']; ?>&Edit=Yes" target="_blank"><?php echo stripslashes($vivian_row['first_name']).' '.stripslashes($vivian_row['last_name']); ?></a> - click on student's name to edit any of their info...
			</td>
			</tr>
			<tr>
			<td>
			&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td style="text-align:center;">
				<table width="700" align="center" border="1" cellspacing="3" cellpadding="3"><form action="video_assign_execute.php" method="Post">
				<?php	
				$querystate = "select DISTINCT class_name from videos order by class_name";
				$resultstate = mysqli_query($cxn, $querystate)
				or die ("Couldn't execute query.");
			
				while ($row=mysqli_fetch_assoc($resultstate))
				{
				extract($row);
				?>
				
				<tr>
				<td bgcolor="#000000" colspan="2">
				<div style="color:#ffffff;"><?php echo stripslashes($row['class_name']); ?></div>
				</td>
				</tr>
				<?php
				$michelle = "select DISTINCT age from videos where class_name='$row[class_name]' order by age";
				$michelle_query = mysqli_query($cxn, $michelle)
				or die ("Couldn't execute query.");
			
				while ($michelle_row=mysqli_fetch_assoc($michelle_query))
				{
				extract($michelle_row);
				?>
				<tr>
				<td bgcolor="#cccccc" colspan="2">
				<?php echo stripslashes($michelle_row['age']); ?>
				</td>
				</tr>
				<tr>
				<?php
				$bruce = "select v.name, v.id as video_id, v.belt, v.class_name, v.age, r.sort_order, r.rank from videos v LEFT OUTER JOIN ranks r on v.belt=r.id 
				where v.class_name='$row[class_name]' and v.age='$michelle_row[age]' order by  r.sort_order";
				$bruce_query=mysqli_query($cxn, $bruce)
				or die("Couldn't do it!");
				while($bruce_row=mysqli_fetch_assoc($bruce_query))
				{
				extract($bruce_row);
				?>
				<tr>
				<td style="width:10px;">
				<?php 
				$david="select * from video_assign where student_id='$vivian_row[id]' and video_id='$video_id'";
				$david_query=mysqli_query($cxn ,$david)
				or die("David didn't happen.");
				$david_count=mysqli_num_rows($david_query);
				if($david_count>0)
				{
				?>
				<input type="checkbox" value="<?php echo $bruce_row['video_id']; ?>" checked name="chkbox_<?php echo $bruce_row['video_id']; ?>">
				<?php
				}
				else
				{
				?>
				<input type="checkbox" value="<?php echo $bruce_row['video_id']; ?>" name="chkbox_<?php echo $bruce_row['video_id']; ?>">
				<?php
				}
				?>
				</td>
				<td>					
				<?php echo stripslashes($bruce_row['name']); ?>	 | <?php echo stripslashes($bruce_row['rank']); ?>				
				</td>
				</tr>					
				<?php
				}
				}
				}
				?>
				</table>
		</td>
		</tr>
		<tr>
		<td style="text-align:center;"><br>
		<input type="hidden" name="student_id" value="<?php echo $vivian_row['id']; ?>"><input type="submit" value="update">
		</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
 <?php require_once('footer.php'); ?>	

