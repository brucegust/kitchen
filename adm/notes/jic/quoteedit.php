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
//here's where I'm checking to see if the featured box is checked and if it is, I update with a "Y" value
$featured_contestant = "UPDATE quotes SET featured='Y' where id='$_POST[ID]'";
$featured_contestant_result = mysqli_query($cxn, $featured_contestant);
}
else
{
//just in case it had been populated before, we go ahead and update it to a null value so we can remove the featured option if need be
$featured_contestant = "UPDATE quotes SET featured='' where id='$_POST[ID]'";
$featured_contestant_result = mysqli_query($cxn, $featured_contestant);
}

$headline = mysqli_real_escape_string($cxn, trim($_POST['name']));
$text = mysqli_real_escape_string($cxn, trim($_POST['description']));
$press_date = date('Y-m-d',strtotime($_POST['month'].' '.$_POST['day'].' '.$_POST['year']));
$display_date = date('F j, Y', strtotime($_POST['month'].' '.$_POST['day'].' '.$_POST['year']));

$query = "UPDATE quotes SET author='$headline',
date= '$press_date',
quote ='$text'
where id = '$_POST[ID]'";

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
			<b>Testimonial Display Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the testimonial you just edited. To make any addtional changes, click on the "Back" button of your browser and repeat the process. Otherwise, to return to the List of Testimonials, click <A HREF="quoteList.php">here</a>.
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
					</tr>
					</table>
				</td>
				</tr>
				<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				 <b>Date:</b>
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<?php echo $display_date; ?>
				</td>
				</tr>
				<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				 <b>Author:</b>
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<?php echo "$_POST[name]"; ?>
				</td>
				</tr>
				<tr>
				<td colspan="2"><?php echo nl2br(stripslashes($_POST['description'])); ?>
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
		
