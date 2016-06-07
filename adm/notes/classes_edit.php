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

include('classes_clean.php'); 

$sort_order=trim($_POST['sort_order']);

$query = "UPDATE classes SET name='$name',
sort_order='$sort_order',
description='$description'
where id = '$_POST[id]'";
$query_result = mysqli_query($cxn, $query);
if(!$query_result)
{
$rats=mysqli_errno($cxn).': '.mysqli_error($cxn);
die($rats);
}

require_once('header.php');	
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Class Edit Page</b>
</td>
</tr>
<tr>
<td>
&nbsp;<BR>
</td>
</tr>
<tr>
<td>
Here's the class you just edited. To return to the list of classes, click <A HREF="classes.php">here</a>.
<P>
<?php require_once('help.php'); ?>
</td>
</tr>
<tr>
<td>
	<table width="600" align="center" border="1"><form action="classes_edit.php" method="Post">
	<tr>
	<td class="black">
	Class Name
	</td>
	<td style="width:400px;">
	<?php echo $_POST['name']; ?>
	</td>
	</tr>
	<tr>
	<td class="black">
	Sort Order
	</td>
	<td style="width:400px;">
	<?php echo $_POST['sort_order']; ?>
	</td>
	</tr>
	<tr>
	<td colspan="2">
	<?php echo $_POST['description']; ?>
	</td>
	</tr>
	</table>
</td>
</tr>
</table>

		
 <?php require_once('footer.php'); ?>	