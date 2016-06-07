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

$article_name= mysqli_real_escape_string($cxn, trim($_POST['article_name']));

$web_address = mysqli_real_escape_string($cxn, trim($_POST['web_address']));

$description = mysqli_real_escape_string($cxn, trim($_POST['description']));

$insert = "insert into articles (page_name, url, description, article_type)
values ('$article_name', '$web_address', '$description', 'website')";
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
			<b>Article / Website Insert </b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the article / website you just entered into the database. To make any changes, click <A HREF="article_list.php">here</a>.
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
					<b>Article Name:</b>
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<?php echo "$_POST[article_name]"; ?>
					</td>
					</tr>
					<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					<b>URL:</b>
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<?php echo "$_POST[web_address]"; ?>
					</td>
					</tr>
					<tr>
					<td colspan="2" bgcolor="#CCCCCC">
					<b>Description</b>
					</td>
					</tr>
					<tr>
					<td colspan="2">
					<?php 
					$textarea = stripslashes(nl2br($_POST['description']));
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
		
