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
$this_year = date("Y");
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
To insert an Event into the calendar, fill in all of the fields, then click on "Submit."
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
	<td><form action="calendar_insert_execute.php" method="post">	
		<table width=100% border="0">
		<tr>
		<td>
		Event Day
		</td>
		<td colspan="2">
		<select name="event_category">
		<option></option>
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
		<input type="text" name="event_name" size="81">
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
		<?php require_once('calendar_insert_start_time.php'); ?>
		</td>
		</tr>
		<tr>
		<td class="MainText" background="../images/spacer.gif" width="200" height="10">
		Event End Time
		</td>
		<td align="right">
		<?php require_once('calendar_insert_end_time.php'); ?>
		</td>
		</tr>
		<tr>
		<td colspan="3"><BR>
		</td>
		</tr>
		<tr>
		<td colspan="3" style="text-align:center;">&nbsp;<BR>
		<textarea name="event_desc">describe the event...</textarea>
		</td>
		</tr>
		<tr>
		<td colspan="3" class="admin_body"><BR>
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