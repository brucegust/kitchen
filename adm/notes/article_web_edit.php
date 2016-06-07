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

$headline = mysqli_real_escape_string($cxn, trim($_POST['article_name']));

$web_address = mysqli_real_escape_string($cxn, trim($_POST['web_address']));

$finaltext = mysqli_real_escape_string($cxn, trim($_POST['description']));

$query = "UPDATE articles SET page_name='$headline',
url ='$web_address',
description ='$finaltext'
where id = '$_POST[id]'";

$result = mysqli_query($cxn, $query);
if (!$result = mysqli_query($cxn, $query)) {
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
			<b>Article / Website Edit Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the article / website you just edited. To make any addtional changes, click on the "Back" button of your browser and repeat the process. Otherwise, to return to the List of Articles, click <A HREF="article_list.php">here</a>.
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
				<table width="700" align="center" border="1">
					<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					 <b>Article / Website Name:</b>
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
					<A HREF="<?php echo "$_POST[web_address]"; ?>" target="_blank"><?php echo "$_POST[web_address]"; ?></a>
					</td>
					</tr>
					<tr>
					<td colspan="2"><?php echo stripslashes(nl2br($_POST['description'])); ?>
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
		
