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

$headline = mysqli_real_escape_string($cxn, trim($_POST['name']));

$bigstory = mysqli_real_escape_string($cxn, trim($_POST['description']));

$insert = "insert into pages (page_name, body)
values ('$headline', '$bigstory')";
$insertexe = mysqli_query($cxn, $insert)
or die ("Couldn't execute query.");

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
			<b>Page Insert </b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the text you just entered into the database. To make any changes, click <A HREF="pageList.php">here</a>, or to add another search, click <A HREF="pageInsert.php">here</a>.
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
					<table width="700" align="center" border="1">
					<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					<b>Page Name:</b>
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<?php echo "$_POST[name]"; ?>
					</td>
					</tr>
					<tr>
					<td colspan="2" bgcolor="#CCCCCC">
					<b>Body</b>
					</td>
					</tr>
					<tr>
					<td colspan="2">
					<?php 
					$textarea = $_POST['description'];
					echo "$textarea";
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
		
