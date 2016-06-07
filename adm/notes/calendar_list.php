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

/*$teresa = "delete from calendar where event_start < '$today'";
$teresa_query = mysqli_query($cxn, $teresa);*/
require_once('header.php');
?>

<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Calendar Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td>
<P>
Below is the list of all the Calendar Events that have been entered into the database. 
<ul>
<li>To either edit or delete an entry, simply click on the lnk to the right of the start and end time</li>
</ul>
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
<td class="admin_columns">
	<table width=100% border="1">
	<tr>
	<td style="background-color:#000000; color:#ffffff; text-align:center;">Event Name</td>
	<td style="background-color:#000000; color:#ffffff; text-align:center;">Start Time | End Time</td>
	<td style="background-color:#000000; color:#ffffff; text-align:center;">Edit / Delete</td>
	<tr>
	<td style="background-color:#cccccc;" colspan="3">
	Monday
	</td>
	</tr>
	<?php
	$bruce="select * from calendar_spreadsheet where day='Monday' order by time_in";
	$bruce_query=mysqli_query($cxn, $bruce)
	or die("couldn't execute query.");
	while($bruce_row=mysqli_fetch_assoc($bruce_query))
	{
	extract($bruce_row);
	?>
	<tr>
	<td>
	<?php echo stripslashes($bruce_row['event']); ?>
	</td>
	<td>
	<?php echo date('g:i a',strtotime($bruce_row['time_in'])).' - '. date('g:i a',strtotime($bruce_row['time_out'])); ?>
	</td>
	<td style="text-align:center;">
	<A HREF="calendar_display.php?id=<?php echo $bruce_row['id']; ?>&Edit=Yes">Edit</a> &nbsp;&nbsp;<A HREF="calendar_display.php?id=<?php echo $bruce_row['id']; ?>&Delete=Yes">Delete</a>
	</td>
	</tr>
	<?php
	}
	?>
	<tr>
	<td style="background-color:#cccccc;" colspan="3">
	Tuesday
	</td>
	</tr>
	<?php
	$michelle="select * from calendar_spreadsheet where day='Tuesday' order by time_in";
	$michelle_query=mysqli_query($cxn, $michelle)
	or die("couldn't execute query.");
	while($michelle_row=mysqli_fetch_assoc($michelle_query))
	{
	extract($michelle_row);
	?>
	<tr>
	<td>
	<?php echo stripslashes($michelle_row['event']); ?>
	</td>
	<td>
	<?php echo date('g:i a',strtotime($michelle_row['time_in'])).' - '. date('g:i a',strtotime($michelle_row['time_out'])); ?>
	</td>
	<td style="text-align:center;">
	<A HREF="calendar_display.php?id=<?php echo $michelle_row['id']; ?>&Edit=Yes">Edit</a> &nbsp;&nbsp;<A HREF="calendar_display.php?id=<?php echo $michelle_row['id']; ?>&Delete=Yes">Delete</a>
	</td>
	</tr>
	<?php
	}
	?>
	<tr>
	<td style="background-color:#cccccc;" colspan="3">
	Wednesday
	</td>
	</tr>
	<?php
	$jorja="select * from calendar_spreadsheet where day='Wednesday' order by time_in";
	$jorja_query=mysqli_query($cxn, $jorja)
	or die("couldn't execute query.");
	while($jorja_row=mysqli_fetch_assoc($jorja_query))
	{
	extract($jorja_row);
	?>
	<tr>
	<td>
	<?php echo stripslashes($jorja_row['event']); ?>
	</td>
	<td>
	<?php echo date('g:i a',strtotime($jorja_row['time_in'])).' - '. date('g:i a',strtotime($jorja_row['time_out'])); ?>
	</td>
	<td style="text-align:center;">
	<A HREF="calendar_display.php?id=<?php echo $jorja_row['id']; ?>&Edit=Yes">Edit</a> &nbsp;&nbsp;<A HREF="calendar_display.php?id=<?php echo $jorja_row['id']; ?>&Delete=Yes">Delete</a>
	</td>
	</tr>
	<?php
	}
	?>
	<tr>
	<td style="background-color:#cccccc;" colspan="3">
	Thursday
	</td>
	</tr>
	<?php
	$vivian="select * from calendar_spreadsheet where day='Thursday' order by time_in";
	$vivian_query=mysqli_query($cxn, $vivian)
	or die("couldn't execute query.");
	while($vivian_row=mysqli_fetch_assoc($vivian_query))
	{
	extract($vivian_row);
	?>
	<tr>
	<td>
	<?php echo stripslashes($vivian_row['event']); ?>
	</td>
	<td>
	<?php echo date('g:i a',strtotime($vivian_row['time_in'])).' - '. date('g:i a',strtotime($vivian_row['time_out'])); ?>
	</td>
	<td style="text-align:center;">
	<A HREF="calendar_display.php?id=<?php echo $vivian_row['id']; ?>&Edit=Yes">Edit</a> &nbsp;&nbsp;<A HREF="calendar_display.php?id=<?php echo $vivian_row['id']; ?>&Delete=Yes">Delete</a>
	</td>
	</tr>
	<?php
	}
	?>
	<tr>
	<td style="background-color:#cccccc;" colspan="3">
	Friday
	</td>
	</tr>
	<?php
	$doodle="select * from calendar_spreadsheet where day='Friday' order by time_in";
	$doodle_query=mysqli_query($cxn, $doodle)
	or die("couldn't execute query.");
	while($doodle_row=mysqli_fetch_assoc($doodle_query))
	{
	extract($doodle_row);
	?>
	<tr>
	<td>
	<?php echo stripslashes($doodle_row['event']); ?>
	</td>
	<td>
	<?php echo date('g:i a',strtotime($doodle_row['time_in'])).' - '. date('g:i a',strtotime($doodle_row['time_out'])); ?>
	</td>
	<td style="text-align:center;">
	<A HREF="calendar_display.php?id=<?php echo $doodle_row['id']; ?>&Edit=Yes">Edit</a> &nbsp;&nbsp;<A HREF="calendar_display.php?id=<?php echo $doodle_row['id']; ?>&Delete=Yes">Delete</a>
	</td>
	</tr>
	<?php
	}
	?>
	<tr>
	<td style="background-color:#cccccc;" colspan="3">
	Saturday
	</td>
	</tr>
	<?php
	$november="select * from calendar_spreadsheet where day='Saturday' order by time_in";
	$november_query=mysqli_query($cxn, $november)
	or die("couldn't execute query.");
	while($november_row=mysqli_fetch_assoc($november_query))
	{
	extract($november_row);
	?>
	<tr>
	<td>
	<?php echo stripslashes($november_row['event']); ?>
	</td>
	<td>
	<?php echo date('g:i a',strtotime($november_row['time_in'])).' - '. date('g:i a',strtotime($november_row['time_out'])); ?>
	</td>
	<td style="text-align:center;">
	<A HREF="calendar_display.php?id=<?php echo $november_row['id']; ?>&Edit=Yes">Edit</a> &nbsp;&nbsp;<A HREF="calendar_display.php?id=<?php echo $november_row['id']; ?>&Delete=Yes">Delete</a>
	</td>
	</tr>
	<?php
	}
	?>
	</table>
</td>
</tr>
</table>
	
 <?php require_once('footer.php'); ?>