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

$headline = trim($_POST['name']);
$slash_headline = addslashes($headline);
$sort_order = trim($_POST['sort_order']);

$bigstory = addslashes($_POST['description']);
$today=date("Y-m-d");

$insert = "insert into quotes (author, quote, date)
values ('$slash_headline', '$bigstory', '$today')";
if (!$result = mysqli_query($cxn, $insert)) {
$error = mysql_errno() . mysql_error();
die($error);
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
			<b>Testimonial Insert </b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the testimonial you just entered into the database. To make any changes, click <A HREF="quoteList.php">here</a>, or to add another testimonial, click <A HREF="quoteInsert.php">here</a>.
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
				<td align="center">	
					<table align="center" border="1">
					<tr>
					<td class="MainText">
					<b>Date:</b>
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<?php echo date("m/d/Y", strtotime($today)); ?>
					</td>
					</tr>
					<tr>
					<td class="MainText">
					<b>Author:</b>
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<?php echo "$_POST[name]"; ?>
					</td>
					</tr>
					<tr>
					<td colspan="2" bgcolor="#CCCCCC">
					<b>Quote:</b>
					</td>
					</tr>
					<tr>
					<td colspan="2">&nbsp;<BR>
					<?php 
					echo stripslashes(nl2br($_POST['description'])); 
					?>
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
			</tr>
			</table>
		</td>
		
		<td>
		<IMG SRC="../images/spacer.gif" width="10" height="10">
		</td>
		</tr>
		</table>

 <?php require_once('footer.php'); ?>	
		
