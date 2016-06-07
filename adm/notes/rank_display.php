<?php
session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
include ("../carter.inc");
if ($_GET['Edit'] != "Yes")
{
$ID=$_GET[ID];
header("Location: rank_delete.php?ID=$ID");
}
else
{
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$query = "select * from ranks where id = '$_GET[ID]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
$row = mysqli_fetch_assoc($result);
extract($row);
}
require_once('header.php');
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Belt Display</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Here's the belt you just selected. Change whatever information you need to alter and then click on "Submit." To return to the List of Belts, click <A HREF="rank_list.php">here</a>.
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
<td class="admin_body">
	<table class="center" border="0"><form action="rank_edit.php" method="post">
	<tr>
	<td class="MainText" background="images/spacer.gif" width="100" height="10">
	 Sort Order
	</td>
	<td>
	<input type="text" size="78" name="sort_order" value="<?php echo "$sort_order"; ?>">
	</td>
	</tr>
	<tr>
	<td class="MainText" background="images/spacer.gif" width="100" height="10">
	 Belt Name
	</td>
	<td>
	<input type="text" size="78" name="name" value="<?php echo "$rank"; ?>">
	</td>
	</tr>
	<tr>
	<td colspan="2" class="admin_body"><input type="hidden" name="ID" value="<?php echo "$id"; ?>">
	<input type="Submit" value="Submit">
	</td>
	</tr>
	</table>
</td>
</tr>
</table>
		
 <?php require_once('footer.php'); ?>	
		