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

$the_category = mysqli_real_escape_string($cxn, trim($_POST['macro_category']));

$query = "update macro_categories set macro_category='$the_category' where id = '$_GET[ID]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");

require_once('header.php');
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Macro Category Edit Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Here's the Macro Category you just edited. If you still to change something, click on the "back" button of your browser to make those changes. Otherwise, to return to the List of Macro Categories, click <A HREF="macro_list.php">here</a>.
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
	<table class="center" border="1"><form action="macro_edit.php" method="post">
		<tr>
		<td class="MainText" background="images/spacer.gif" width="100" height="10">
		 Name
		</td>
		<td>
		<input type="text" size="45" name="macro_category" value="<?php echo $_POST['macro_category']; ?>">
		</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
		
 <?php require_once('footer.php'); ?>	
		