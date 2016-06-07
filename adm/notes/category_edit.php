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
$the_sort_order = trim($_POST['sort_order']);

$query = "UPDATE calendar_category SET name='$event_name',
sort_order='$the_sort_order',
description='$event_description'
where id = '$_POST[id]'";
$query_go=mysqli_query($cxn, $query);
if(!$query_go)
{
$nuts=mysqli_errno($cxn).': '.mysqli_error($cxn);
die($nuts);
exit();
}

$michelle="select sum(sort_order) as sort_value from calendar_category";
$michelle_query=mysqli_query($cxn, $michelle)
or die("Michelle is not happy.");
$michelle_row=mysqli_fetch_assoc($michelle_query);
extract($michelle_row);

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
			<b>Calendar Category Display Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Here's the calendar category  you just edited. To make any addtional changes, click on the "Back" button of your browser and repeat the process. Otherwise, to return to the Category List, click <A HREF="category_list.php">here</a>.
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
				<table align="center" border="1" width="700" cellspacing="3" cellpadding="3">
					<?php if($michelle_row['sort_value']>0)
					{
					?>
					<tr>
					<td class="MainText" background="images/spacer.gif" width="200" height="10">
					<b>Sort Order</b>
					</td>
					<td>
					<?php echo $_POST['sort_order']; ?>
					</td>
					</tr>
					<?php
					}
					?>
					<tr>
					<td class="MainText" background="images/spacer.gif" width="200" height="10">
					<b>Category Name</b>
					</td>
					<td>
					<?php echo $_POST['event_name']; ?>
					</td>
					</tr>
					<tr>
					<td class="MainText" height="10" colspan="2">
					<b>Category Description</b>
					</td>
					</tr>
					<tr>
					<td colspan="2">
					<?php echo stripslashes($_POST['event_description']); ?>
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
		
