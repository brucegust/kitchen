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

$category = mysqli_real_escape_string($cxn, trim($_POST['category']));
$sort_order=trim($_POST['sort_order']);

$query = "UPDATE calendar_category SET category='$category',
sort_order='$sort_order'
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
			Here's the Calendar Category you just edited. To make any addtional changes, click on the "Back" button of your browser and repeat the process. Otherwise, to return to the Category List, click <A HREF="calendar_category_list.php">here</a>.
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
				<table align="center" border="1" width="700">
				<tr>
				<td class="MainText">
				Sort Order
				</td>
				<td>
				<?php echo $_POST['sort_order']; ?>
				</td>
				</tr>
				<tr>
				<td class="MainText" background="images/spacer.gif" width="150" height="10">
				Category
				</td>
				<td>
				<?php echo $_POST['category']; ?>
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
		