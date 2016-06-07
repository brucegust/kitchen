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

if(!empty($_POST['featured'])){
$flag=1;
//if the featured field is not blank, begin by eliminating all previous "featured" entries
$featured_update= "UPDATE news SET featured=''";
$featured_result = mysqli_query($cxn, $featured_update);
//now update the field base on the contestant's id
$featured_contestant = "UPDATE news SET featured='Y' where id='$_POST[ID]'";
$featured_contestant_result = mysqli_query($cxn, $featured_contestant);
if(!$featured_contestant_result) { 
$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
die($error);
}
}
else
{
$flag=0;
}

$event_name = mysqli_real_escape_string($cxn, trim($_POST['event_name']));
$event_description = mysqli_real_escape_string($cxn, trim($_POST['event_description']));
$event_date = date('Y-m-d',strtotime($_POST['month'].' '.$_POST['day'].' '.$_POST['year']));
$display_date = date('F j, Y', strtotime($_POST['month'].' '.$_POST['day'].' '.$_POST['year']));

$query = "UPDATE event SET event_name='$event_name',
event_description='$event_description',
event_date='$event_date'
where id = '$_POST[id]'";
$query_go=mysqli_query($cxn, $query);
if(!$query_go)
{
$nuts=mysqli_errno($cxn).': '.mysqli_error($cxn);
die($nuts);
exit();
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
			<b>Event Display Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the eventyou just edited. To make any addtional changes, click on the "Back" button of your browser and repeat the process. Otherwise, to return to the Event List, click <A HREF="event_list.php">here</a>.
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
				<table align="center" border="0"><form action="class_insert_execute.php" method="post">
					<tr>
					<td class="MainText" background="images/spacer.gif" width="300" height="10">
					<b>Event Name</b>
					</td>
					<td>
					<?php echo $_POST['event_name']; ?>
					</td>
					</tr>
					<tr>
					<td>
					<b>Event Date</b>
					</td>
					<td>
					<?php echo $display_date; ?>
					</td>
					</tr>
					<tr>
					<td class="MainText" height="10">&nbsp;<BR>
					<b>Event Description</b>
					</td>
					</tr>
					<tr>
					<td colspan="2">
					<textarea class="description"><?php echo stripslashes($_POST['event_description']);?></textarea>
					</td>
					</tr>
					</table>
	
			</td>
			<td>
			<IMG SRC="../images/spacer.gif" width="10" height="10">
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
		
