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

if($_POST['start_morning_evening']=="pm")
{
$start_hour=$_POST['start_hour']+12;
}
else
{
$start_hour=$_POST['start_hour'];
}

$jorja= $start_hour.':'.$_POST['start_minutes'];
$jorja.=":00";
$event_start = date('H:i:s',strtotime($jorja));

if($_POST['end_morning_evening']=="pm")
{
$end_hour=$_POST['end_hour']+12;
}
else
{
$end_hour=$_POST['end_hour'];
}

$vivian= $end_hour.':'.$_POST['end_minutes'];
$vivian.=":00";
$event_end = date('H:i:s',strtotime($vivian));

$event_name = mysqli_real_escape_string($cxn, trim($_POST['event_name']));
$event_category= mysqli_real_escape_string($cxn, trim($_POST['event_category']));
$event_desc = mysqli_real_escape_string($cxn, trim($_POST['event_desc']));

$bruce="update calendar_spreadsheet set day='$event_category',
event='$event_name',
event_desc = '$event_desc', 
time_in='$event_start',
time_out='$event_end'
where id='$_POST[id]'";
$bruce_query=mysqli_query($cxn, $bruce)
or die("Couldn't execute Bruce.");

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
	<b>Calendar Edit Page</b>
	</td>
	</tr>
	<tr>
	<td>&nbsp;<BR>
	</td>
	</tr>
	<tr>
	<td class="MainText">
	<P>
	Below are the details of the event you just edited <b><?php echo $_POST['event_category']; ?></b>. If everything looks good, you're done. If you need to change something, click <A HREF="calendar_list.php">here</a> to access your list of calendar events.
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
	<td class="admin_body">
		<table class="center" width="800" border="1" cellspacing="3" cellpadding="3">
		<tr>
		<td background="images/spacer.gif" width="200" height="10">
		<b>Event Category</b>
		</td>
		<td>
		<?php echo $_POST['event_category']; ?>		
		</td>
		</tr>
		<tr>
		<td>
		<b>Event Name</b>
		</td>
		<td>
		<?php echo $_POST['event_name']; ?>
		</td>
		</tr>
				<tr>
		<td background="../images/spacer.gif" width="200" height="10">
		<b>Event Start Date / Time</b>
		</td>
		<td align="right">
		<?php echo date('g:i a',strtotime($jorja)); ?>
		</td>
		</tr>
		<tr>
		<td>
		<b>Event End Date / Time</b>
		</td>
		<td align="right">
		<?php 
		echo date('g:i a', strtotime($vivian)); 
		?>
		</td>
		</tr>
		<tr>
		<td colspan="2">
		<b><u>Event Description</u></b>
		</td>
		</tr>
		<tr>
		<td colspan="2" background="images/spacer.gif" width="800" height="10">
		<?php echo $_POST['event_desc']; ?>
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