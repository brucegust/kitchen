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

if($_GET['field']=="end_repeating_date")
{
$missing_field="End Repeat Date";
}

if($_GET['field']=="start_time")
{
$missing_field="Start Time";
}

if($_GET['field']=="start_date")
{
$missing_field="Start Date";
}

if($_GET['field']=="end_time")
{
$missing_field="End Time";
}

if($_GET['field']=="end_date")
{
$missing_field="End Date";
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
			<b>Alert</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Whoops!
			
			You forgot something! Click <a href="#" onclick="history.go(-1)">here</a> and check the "<b><?php echo $missing_field; ?></b>" field.
			<P>
			<?php include ("help.php"); ?>
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