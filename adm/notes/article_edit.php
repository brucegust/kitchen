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

if(!empty($_POST['retired'])){
//here's where I'm checking to see if the retired box is checked and if it is, I update with a "Y" value
$retired_contestant = "UPDATE articles SET retired='Y' where id='$_POST[id]'";
$retired_contestant_result = mysqli_query($cxn, $retired_contestant);
}
else
{
//just in case it had been populated before, we go ahead and update it to a null value so we can remove the retired option if need be
$retired_contestant = "UPDATE articles SET retired='' where id='$_POST[id]'";
$retired_contestant_result = mysqli_query($cxn, $retired_contestant);
}

if(!empty($_POST['featured'])){
//here's where I'm checking to see if the featured box is checked and if it is, I update with a "Y" value
$featured_contestant = "UPDATE articles SET featured='Y' where id='$_POST[id]'";
$featured_contestant_result = mysqli_query($cxn, $featured_contestant);
}
else
{
//just in case it had been populated before, we go ahead and update it to a null value so we can remove the featured option if need be
$featured_contestant = "UPDATE articles SET featured='' where id='$_POST[id]'";
$featured_contestant_result = mysqli_query($cxn, $featured_contestant);
}

$headline = mysqli_real_escape_string($cxn, trim($_POST['name']));

$finaltext = mysqli_real_escape_string($cxn, trim($_POST['description']));

$query = "UPDATE articles SET page_name='$headline',
body ='$finaltext'
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
			<b>Article Display Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the article you just edited. To make any addtional changes, click on the "Back" button of your browser and repeat the process. Otherwise, to return to the List of Articles, click <A HREF="article_list.php">here</a>.
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
				<td colspan="2" bgcolor="#cccccc" align="right">
					<table>
					<tr>
					<td>
					featured&nbsp;
					<?php
					if(empty($_POST['featured'])){
					?>
					<input type="checkbox" value="Y" name="featured">
					<?php
					}
					else
					{
					?>
					<input type="checkbox" value="Y" name="featured" checked>
					<?php
					}
					?>
					</td>
					<td>
					retired&nbsp;
					<?php
					if(empty($_POST['retired'])){
					?>
					<input type="checkbox" value="Y" name="retired">
					<?php
					}
					else
					{
					?>
					<input type="checkbox" value="Y" name="retired" checked>
					<?php
					}
					?>
					</td>
					</tr>
					</table>
				</td>
				</tr>
				<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				 <b>Name:</b>
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<?php echo "$_POST[name]"; ?>
				</td>
				</tr>
				<tr>
				<td colspan="2"><?php echo stripslashes($_POST['description'])?>
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
		
