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

$event_name = mysqli_real_escape_string($cxn, trim($_POST['event_name']));
$event_description = mysqli_real_escape_string($cxn, trim($_POST['event_description']));
$event_date = date('Y-m-d',strtotime($_POST['month'].' '.$_POST['day'].' '.$_POST['year']));
$display_date = date('F j, Y', strtotime($_POST['month'].' '.$_POST['day'].' '.$_POST['year']));

$insert = "insert into event (event_name, event_date, event_description)
values ('$event_name', '$event_date', '$event_description')";
$insertexe = mysqli_query($cxn, $insert);
if(!$insertexe){
$dang_it = mysqli_errno($cxn).': '.mysqli_error($cxn);
die($dang_it);
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
			<b>Event Insert Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the event you just entered into the database. To make any changes, click <A HREF="event_list.php">here</a>, or to add another event, click <A HREF="event_insert.php">here</a>.
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
				<table style="margin:auto; width:700px;"><form action="class_insert_execute.php" method="post">
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
			</tr>
			</table>
		</td>
		
		<td>
		<IMG SRC="../images/spacer.gif" width="10" height="10">
		</td>
		</tr>
		</table>

 <?php require_once('footer.php'); ?>	
		
