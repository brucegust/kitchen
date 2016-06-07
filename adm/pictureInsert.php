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
<b>Staff Member Insert Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
To insert a staff member into the database, fill in all of the fields, then click on "Submit."
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
	<table width="700" class="center" border="0"><form enctype="multipart/form-data" action="photo_insert_execute.php" method="POST">
	<tr>
	<td class="MainText" background="../images/spacer.gif" width="200" height="10">
	Staff Member Name
	</td>
	<td background="../images/spacer.gif" width="500" height="10">
	<input type="text" size="80" name="name">
	</td>
	</tr>
	<tr>
	<td class="MainText" background="../images/spacer.gif" width="200" height="10">
	Photo
	</td>
	<td>
	<input name="photo" type="file" size="66">
	</td>
	</tr>
	<tr>
	<td colspan="2" class="admin_body">&nbsp;<BR>
	<textarea name="description">Bio</textarea>
	</td>
	</tr>
	<tr>
	<td colspan="2" class="admin_body">&nbsp;<BR>
	<input type="Submit" value="Submit">
	</td>
	</tr>
	</table>
</td>
</tr>
</table>

 <?php require_once('footer.php'); ?>	