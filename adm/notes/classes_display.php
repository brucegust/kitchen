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

if ($_GET['Edit'] != "Yes")
{
$id=$_GET['id'];
header("Location: classes_delete.php?id=$id");
exit();
}

$bruce = "select * from classes where id='$_GET[id]'";
$bruce_query = mysqli_query($cxn, $bruce)
or die("Not working");
$bruce_row=mysqli_fetch_assoc($bruce_query);
extract($bruce_row);
 
require_once('header.php');	
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Class Display Page</b>
</td>
</tr>
<tr>
<td>
&nbsp;<BR>
</td>
</tr>
<tr>
<td>
Here's the class you just selected. To make any changes, enter the correct information in the appropriate field and click on "submit."
<P>
<?php require_once('help.php'); ?>
</td>
</tr>
<tr>
<td>
	<table align="center" border="1" align="center"><form action="classes_edit.php" method="Post">
	<tr>
	<td class="black">
	Class Name
	</td>
	<td>
	<input type="text" size="105" name="name" value="<?php echo stripslashes($bruce_row['name']); ?>">
	</td>
	</tr>
	<tr>
	<td class="black">
	Sort Order
	</td>
	<td>
	<input type="text" size="105" name="sort_order" value="<?php echo stripslashes($bruce_row['sort_order']); ?>">
	</td>
	</tr>
	</table><br>
	<table align="center">
	<tr>
	<td colspan="2"><br>
	<div align="center"><textarea class="comments" name="description"><?php echo stripslashes(nl2br($bruce_row['description'])); ?></textarea></div>
	</td>
	</tr>
	<tr>
	<td colspan="2" style="text-align:center;"><br><input type="hidden" name="id" value="<?php echo $bruce_row['id']; ?>">
	<input type="submit" value="submit">
	</td>
	</tr>
	</table>
</td>
</tr>
</table>

		
 <?php require_once('footer.php'); ?>	