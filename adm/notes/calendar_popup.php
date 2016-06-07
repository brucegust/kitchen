<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Trinity  | Admin Page</title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
<?php
error_reporting(E_ALL);
include ("../carter.inc");
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$bruce="select * from calendar where id='$_GET[id]'";
$bruce_query=mysqli_query($cxn, $bruce)
or die("Couldn't execute query.");
$bruce_row=mysqli_fetch_assoc($bruce_query);
extract($bruce_row);
?>

<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td colspan="2">
<IMG SRC="images/calendar_header.jpg">
</td>
</tr>
<tr>
<td colspan="2">&nbsp;<BR><BR>
</td>
</tr>
<tr>
<td>
<IMG SRC="../images/spacer.gif" width="10" height="10">
</td>
<td>
	<table align="center" border="0" cellspacing="3" cellpadding="3">
	<tr>
	<td>
	<b>Event Category</b>
	</td>
	<td colspan="2" align="right">
	<?php echo stripslashes($bruce_row['event_category']); ?>
	</td>
	</tr>
	<tr>
	<td>
	<b>Event Name</b>
	</td>
	<td colspan="2" align="right">
	<?php echo stripslashes($bruce_row['event_name']); ?>
	</td>
	</tr>
	<tr>
	<td class="MainText" background="../images/spacer.gif" width="200" height="10">
	<b>Event Start Date / Time</b>
	</td>
	<td colspan="2" align="right">
	<?php echo date('l, F j, Y g:i a',strtotime($bruce_row['event_start'])); ?>
	</td>
	</tr>
	<tr>
	<td class="MainText" background="../images/spacer.gif" width="200" height="10">
	<b>Event End Date / Time</b>
	</td>
	<td colspan="2" align="right">
	<?php echo date('l, F j, Y g:i a',strtotime($bruce_row['event_end'])); ?>
	</td>
	</tr>
	<tr>
	<td colspan="3">
	<b><u>Event Description</u></b>
	</td>
	</tr>
	<tr>
	<td colspan="3">
	<?php echo stripslashes(nl2br($bruce_row['event_desc'])); ?>
	</td>
	</tr>
	</table>
</td>
</tr>
</table>

</body>
</html>
