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

$query = "select * from black_belt where id = '$_GET[ID]'";
$result = mysqli_query($cxn, $query);
if(!$result)
{
$nuts=mysqli_errno($cxn).': '.mysqli_error($cxn);
die($nuts);
}
$row = mysqli_fetch_assoc($result);
extract($row);

require_once('header.php');
 
?>


<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Black Belt Delete Page</b>
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
	<table align="center" border="0" cellspacing="1" cellpadding="1"><form action="belt_delete_execute.php" method="Post">
	<tr>
	<td>	
	To delete,<b>"<?php echo stripslashes($row['first_name']).' '.stripslashes($row['last_name']); ?>"</b>, click on the "Delete" button below. Otherwise, click <A HREF="belt_list.php">here</a> to return to the List of Black Belts.
	<P>
	<?php include ("help.php"); ?>
	</td>
	</tr>
	<td>&nbsp;<BR>
	</td>
	</tr>
	<tr>
	<td class="admin_body"><input type="hidden" name="ID" value="<?php echo $row['id']; ?>">
	<input type="Submit" value="Delete"></form>
	</tr>
	</table>
</td>
</tr>
</table>
			
		

 <?php require_once('footer.php'); ?>	
		
