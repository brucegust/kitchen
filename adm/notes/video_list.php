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
			<b>Video List</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Below is the list of all the video files that have been entered into the database. To either edit or delete an entry, simply click on one of the two links located at the bottom of each description.
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
				<td align="center" background="../images/spacer.gif" width="700" height="10">
					<table width="700" align="center" border="1">
					<?php	
					$current_age="";
					$current_class_name="";
					$querystate = "select v.name, v.id as video_id, v.belt, v.class_name, v.age, r.sort_order, r.rank from videos v LEFT OUTER JOIN ranks r on v.belt=r.id order by  r.sort_order";
					$resultstate = mysqli_query($cxn, $querystate)
					or die ("Couldn't execute query.");
				
					while ($row=mysqli_fetch_assoc($resultstate))
					{
					extract($row);
					?>
						<?php
						if($current_class_name<>$row['class_name'])
						{
						?>
						<tr>
						<td bgcolor="#000000" colspan="2">
						<div style="color:#ffffff;"><?php echo stripslashes($row['class_name']); ?></div>
						</td>
						</tr>
						<?php
						}
						?>
						<?php
							if($current_age<>$row['age'])
							{
						?>
							<tr>
							<td bgcolor="red" colspan="2">
							<div style="color:#ffffff;"><?php echo stripslashes($row['age']); ?></div>
							</td>
							</tr>
							<?php
							}
							?>
					<tr>
					<td background="../images/spacer.gif" width="500" height="10">					
					<?php 
					$scott="select * from ranks where id='$row[belt]'";
					$scott_query=mysqli_query($cxn, $scott)
					or die("Couldn't execute scott.");
					$scott_row=mysqli_fetch_assoc($scott_query);
					extract($scott_row);
					?>
					<A HREF="video_player.php?id=<?php echo $row['video_id']; ?>" target="_blank"><?php
					echo stripslashes($scott_row['rank']).' | '.stripslashes($row['name']); ?></a>
										
					</td>
					<td style="text-align:center;" bgcolor="#cccccc">
					<A HREF="video_display.php?ID=<?php echo $row['video_id']; ?>&Edit=Yes">Edit</a>&nbsp;&nbsp;
					<A HREF="video_display.php?ID=<?php echo $row['video_id']; ?>&Delete=Yes">Delete
					</td>
					</tr>
					<?php
					$current_class_name=$row['class_name'];
					$current_age=$row['age'];
					}
					?>
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

