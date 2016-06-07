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

$event_name = mysqli_real_escape_string($cxn, trim($_POST['name']));
$event_description = mysqli_real_escape_string($cxn, trim($_POST['description']));

$insert = "insert into calendar_category (name, description)
values ('$event_name', '$event_description')";
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
			<b>Calendar Category Insert Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the Category you just entered into the database. To make any changes, click <A HREF="category_list.php">here</a>, or to add another event, click <A HREF="category_insert.php">here</a>.
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
					<table align="center" width="700" border="1">
					<tr>
					<td class="MainText" background="images/spacer.gif" width="200" height="10">
					<b>Category Name</b>
					</td>
					<td>
					<?php echo $_POST['name']; ?>
					</td>
					</tr>
					<tr>
					<td class="MainText" height="10" colspan="2">
					<b>Category Description</b>
					</td>
					</tr>
					<tr>
					<td colspan="2">
					<?php echo stripslashes($_POST['description']); ?>
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
		
