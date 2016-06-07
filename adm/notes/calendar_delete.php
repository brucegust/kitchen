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

$query = "select * from calendar_spreadsheet where id = '$_GET[ID]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
$row = mysqli_fetch_assoc($result);
extract($row);

$name = stripslashes($event);
$ID = $id;

require_once('header.php');
 
?>

<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Event Delete Page</b>
</td>
</tr>
<tr>
<td>
&nbsp;<BR>
</td>
</tr>
<tr>
<td>
To delete,<b>"<?php echo stripslashes($name); ?>"</b>, click on the "Delete" button below. Otherwise, click <A HREF="calendar_list.php">here</a> to return to the Calendar List.
<P>
<?php include ("help.php"); ?>
</td>
</tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr><form action="calendar_delete_execute.php" method="Post">
<td class="admin_body"><input type="hidden" name="do" value="delete"><input type="hidden" name="ID" value="<?php echo "$ID"; ?>">
<input type="Submit" value="Delete"></form>

</table>

 <?php require_once('footer.php'); ?>	