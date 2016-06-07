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
Below is the list of all the belts that have been entered into the database. To either edit or delete an entry, simply click on one of the two links located at the bottom of each belt name.
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
	<table width="700" class="center" border="1">
	<tr>
	<td class="black" background="../images/spacer.gif" width="150" height="10">
	<div align="center">Sort Order:</div>
	</td>
	<td class="black" background="../images/spacer.gif" width="400" height="10">
	<div align="center">Belt Name:</div>
	</td>
	<td class="black" background="../images/spacer.gif" width="350" height="10">
	<div align="center">Edit / Delete:</div>
	</td>
	</tr>
	<?php	
	$querystate = "select * from ranks order by sort_order";
	$resultstate = mysqli_query($cxn, $querystate)
	or die ("Couldn't execute query.");
	while ($row=mysqli_fetch_assoc($resultstate))
	{
	extract($row);
	?>
	<tr>
	<td>
	<?php echo "$sort_order"; ?>
	</td>
	<td>
	<?php echo "$rank"; ?>
	</td>
	<td class="top_header">
	<A HREF="rank_display.php?ID=<?php echo "$id"; ?>&Edit=Yes">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<A HREF="rank_display.php?ID=<?php echo "$id"; ?>&Delete=Yes">Delete</a>
	</td>
	</tr>
	<?php
	}
	?>
	</table>&nbsp;<BR>
</td>
</tr>
</table>

<?php require_once('footer.php'); ?>
