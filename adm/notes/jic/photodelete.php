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
$query = "select * from photos where id = '$_GET[ID]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
$row = mysqli_fetch_assoc($result);
extract($row);
$name = $name;
$ID = $id;
require_once('header.php'); 
 
?>
	
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Staff Delete Page</b>
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
	<table width="900" class="center" border="0" cellspacing="1" cellpadding="1"><form action="photodelete_execute.php" method="Post">
	<tr>
	<td>	
	To delete <b>"<?php echo "$name"; ?>"</b>, click on the "Delete" button below. Otherwise, click <A HREF="photoList.php">here</a> to return to the Staff List.
	<P>
	<?php include ("help.php"); ?>
	</td>
	</tr>
	<td>&nbsp;<BR>
	</td>
	</tr>
	<tr>
	<td class="admin_body"><input type="hidden" name="do" value="delete"><input type="hidden" name="ID" value="<?php echo "$ID"; ?>">
	<input type="Submit" value="Delete"></form>
	</tr>
	</table>
</td>
</tr>
</table>
			

 <?php require_once('footer.php'); ?>	
		