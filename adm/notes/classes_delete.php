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

$query = "select * from classes where id = '$_GET[id]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
$row = mysqli_fetch_assoc($result);
extract($row);

$ID = $id;
 
require_once('header.php');	
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%><form action="classes_delete_execute.php" method="Post">
<tr>
<td class="TitleText">
<b>Class Delete Page</b>
</td>
</tr>
<tr>
<td>
&nbsp;<BR>
</td>
</tr>
<tr>
<td>
To delete the <b>"<?php echo stripslashes($row['name']); ?>"</b> class, click on the "Delete" button below. Otherwise, click <A HREF="classes.php">here</a> to return to the list of classes.
<P>
<?php require_once('help.php'); ?>
</td>
</tr>
<tr>
<td class="top_header"><BR><input type="hidden" value="delete"><input type="hidden" name="ID" value="<?php echo "$ID"; ?>">
<input type="Submit" value="delete"></form></td>
</tr>
</table>
</form>
		
 <?php require_once('footer.php'); ?>	