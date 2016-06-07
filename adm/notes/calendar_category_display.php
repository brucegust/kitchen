<?php
session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
if ($_GET['Edit'] != "Yes")
{
$ID=$_GET[ID];
header("Location: calendar_category_delete.php?ID=$ID");
}
else
{
include ("../carter.inc");
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$query = "select * from calendar_category where id = '$_GET[ID]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
$row = mysqli_fetch_assoc($result);
extract($row);
}
$ID=$_GET['ID'];
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
			To edit the Calendar Category, make your changes in the fields below and click on "Submit." To return to the Category list, click <A HREF="calendar_category_list.php">here</a>.
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
					<table align="center" border="0"><form action="calendar_category_edit.php" method="post">
					<tr>
					<td>
					Sort Order
					</td>
					<td>
					<input type="text" size="85" name="sort_order" value="<?php echo stripslashes($sort_order); ?>">
					</td>
					</tr>
					<tr>
					<td class="MainText" background="images/spacer.gif" width="100" height="10">
					Category
					</td>
					<td>
					<input type="text" size="85" name="category" value="<?php echo stripslashes($category); ?>">
					</td>
					</tr>
					<tr>
					<td colspan="2" align="center"><input type="hidden" name="id" value="<?php echo $ID; ?>"><BR>
					<input type="Submit" value="Submit">
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