<?php
session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
include ("../carter.inc");
if ($_GET['Edit'] != "Yes")
{
$ID=$_GET['id'];
header("Location: calendar_delete.php?ID=$ID");
}
$this_year = date("Y");

include ("../carter.inc");
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");

$bruce="select * from calendar_spreadsheet where id='$_GET[id]'";
$bruce_query=mysqli_query($cxn, $bruce)
or die("Couldn't execute Bruce.");
$bruce_row=mysqli_fetch_assoc($bruce_query);
extract($bruce_row);
require_once('header.php');
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td>
<b>Calendar Insert Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td>
<P>
Here is the Calendar Event you just selected. Make your changes and then click on "submit."
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
<td class="admin__body">
	<table width="800" border="0" class="center">
	<tr>
	<td>
	<IMG SRC="../images/spacer.gif" width="10" height="10">
	</td>
	<td><form action="calendar_edit.php" method="post">	
		<table width=100% border="0">
		<tr>
		<td>
		Event Day
		</td>
		<td colspan="2">
		<select name="event_category">
		<option selected><?php echo stripslashes($bruce_row['day']); ?></option>
		<option>Monday</option>
		<option>Tuesday</option>
		<option>Wednesday</option>
		<option>Thursday</option>
		<option>Friday</option>
		<option>Saturday</option>
		<option>_____________________________________________________________________</option>
		</select>
		</td>
		</tr>
		<tr>
		<td colspan="3">
		&nbsp;
		</td>
		</tr>
		<tr>
		<td>
		Event Name
		</td>
		<td colspan="2">
		<input type="text" name="event_name" size="81" value="<?php echo stripslashes($bruce_row['event']); ?>">
		</td>
		</tr>
		<tr>
		<td colspan="3">
		&nbsp;
		</td>
		</tr>
		<tr>
		<td class="MainText" background="../images/spacer.gif" width="200" height="10">
		Event Start Time
		</td>
		<td align="right">
		<?php require_once('calendar_insert_start_time_display.php'); ?>
		</td>
		</tr>
		<tr>
		<td class="MainText" background="../images/spacer.gif" width="200" height="10">
		Event End Time
		</td>
		<td align="right">
		<?php require_once('calendar_insert_end_time_display.php'); ?>
		</td>
		</tr>
		<tr>
		<td colspan="3"><BR>
		</td>
		</tr>
		<tr>
		<td colspan="3" style="text-align:center;">&nbsp;<BR>
		<textarea name="event_desc"><?php echo stripslashes($bruce_row['event_desc']); ?></textarea>
		</td>
		</tr>
		<tr>
		<td colspan="3" class="admin_body"><input type="hidden" name="id" value="<?php echo $bruce_row['id']; ?>"><BR>
		<input type="Submit" value="Submit">
		</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
</td>
</tr>
</table>
	
 <?php require_once('footer.php'); ?>	