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
require_once('header.php'); 
?>

<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Belt List</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Below is the list of all the black belts that have been entered into the database. To either edit or delete an entry, simply click on one of the two links located to the right of each name.
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
	<table width=100% border="1">
	<tr>
	<td bgcolor="#cccccc">
	Name
	</td>
	<td bgcolor="#cccccc">
	Rank
	</td>
	<td bgcolor="#cccccc" class="admin_body">
	Edit / Delete
	</td>
	</tr>
	<?php	
	$querystate = "select * from black_belt order by belt_sort_order DESC, last_name";
	$resultstate = mysqli_query($cxn, $querystate);
	if(!$resultstate)
	{
	$rats=mysqli_errno($cxn).':'.mysqli_error($cxn);
	die($rats);
	}
	while ($row=mysqli_fetch_assoc($resultstate))
	{
	extract($row);
	?>
	<tr>
	<td>
	<?php echo stripslashes($row['first_name']).' ' .stripslashes($row['last_name']); ?>
	</td>
	<td>
	<?php echo stripslashes($row['belt']); ?>
	</td>
	<td bgcolor="#cccccc" class="admin_body">
	<A HREF="belt_display.php?id=<?php echo $row['id']; ?>&Edit=Yes">Edit</a>&nbsp;&nbsp;<A HREF="belt_display.php?id=<?php echo $row['id']; ?>&Delete=Yes">Delete</a>
	</td>
	</tr>
	<?php 
	}
	?>
	</table>
<td>
<IMG SRC="../images/spacer.gif" width="10" height="10">
</td>
</tr>
</table>