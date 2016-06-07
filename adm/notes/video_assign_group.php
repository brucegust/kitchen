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
<td class="TitleText">
<b>Video Group Assign Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
<HR>
	<table width="100%" align="center"><form action="video_assign_group_display.php" method="Post">
	<tr>
	<td>
	Start by selecting the class you're interested in looking at and the rank of those in that class
	</td>
	<td>
	<select name="video_class">
	<option>class</option>
	<?php 
	$vivian = "select * from classes order by sort_order";
	$vivian_query=mysqli_query($cxn, $vivian)
	or die("Couldn't execute query.");
	while($vivian_row=mysqli_fetch_assoc($vivian_query))
	{
	extract($vivian_row);
	?>
	<option value="<?php echo $vivian_row['name']; ?>"><?php echo stripslashes($vivian_row['name']); ?></option>
	<?php
	}
	?>
	</select>
	</td>
	<td>
	<select name="video_belt">
	<option>belt</option>
	<?php 
	$jorja = "select * from ranks order by sort_order";
	$jorja_query=mysqli_query($cxn, $jorja)
	or die("Couldn't execute query.");
	while($jorja_row=mysqli_fetch_assoc($jorja_query))
	{
	extract($jorja_row);
	?>
	<option value="<?php echo $jorja_row['id']; ?>"><?php echo stripslashes($jorja_row['rank']); ?></option>
	<?php
	}
	?>
	</select>
	</td>
	<td>
	<select name="videos">
	<option>videos</option>
	<?php 
	$jorja = "select * from videos order by class_name, belt";
	$jorja_query=mysqli_query($cxn, $jorja)
	or die("Couldn't execute query.");
	while($jorja_row=mysqli_fetch_assoc($jorja_query))
	{
	extract($jorja_row);
	$bruce="select * from ranks where id='$jorja_row[belt]'";
	$bruce_query=mysqli_query($cxn, $bruce)
	or die("Couldn't execute Bruce.");
	$bruce_row=mysqli_fetch_assoc($bruce_query);
	extract($bruce_row);
	?>
	<option value="<?php echo $jorja_row['id']; ?>"><?php echo stripslashes($jorja_row['name']).' | '.stripslashes($bruce_row['rank']); ?></option>
	<?php
	}
	?>
	</select>
	</td>
	<td>
	<input type="submit" value="submit"></form>
	</td>
	</tr>
	</table>	<HR>	
</td>
</tr>
<tr>
<td><br>
<?php include ("help.php"); ?>
</td>
</tr>
</table>
		
 <?php require_once('footer.php'); ?>	

