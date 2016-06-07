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

$query = "delete from classes where id='$_POST[ID]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
 
require_once('header.php');	
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
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
Congratulations! You've successfully deleted your seletion. Click <A HREF="classes.php">here</a> to return to the list of classes.
<P>
<?php require_once('help.php'); ?>
</td>
</tr>
</table>
		
 <?php require_once('footer.php'); ?>	