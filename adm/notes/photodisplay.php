<?php
session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
include ("../carter.inc");
if ($_GET['Edit'] != "Yes")
{
$ID=$_GET['ID'];
header("Location: photodelete.php?ID=$ID");
}
else
{
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$query = "select * from photos where id = '$_GET[ID]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
$row = mysqli_fetch_assoc($result);
extract($row);
require_once('header.php');
}
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Staff Display Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Here's the staff member you just selected. Change whatever information you need to alter and then click on "Submit." To return to the Staff List, click <A HREF="photolist.php">here</a>.
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
	<table class="center" border="0"><form action="photoedit.php" method="Post">
	<tr>
	<td class="MainText" background="../images/spacer.gif" width="200" height="10">
	Sort Order
	</td>
	<td background="../images/spacer.gif" width="500" height="10">
	<input type="text" size="80" name="sort_order" value="<?php echo $sort_order; ?>">
	</td>
	</tr>
	<tr>
	<td class="MainText" background="../images/spacer.gif" width="200" height="10">
	Staff Name
	</td>
	<td background="../images/spacer.gif" width="500" height="10">
	<input type="text" size="80" name="name" value="<?php $photo=stripslashes($name); echo "$photo"; ?>">
	</td>
	</tr>
	<tr>
	<td class="MainText" background="../images/spacer.gif" width="200" height="10">
	<A HREF="../Photos/<?php echo $url; ?>" target="_blank">URL</a>
	</td>
	<td background="../images/spacer.gif" width="500" height="10">
	<input type="text" size="80" name="url" value="<?php echo "$url"; ?>">
	</td>
	</tr>
	<tr>
	<td colspan="2"><BR></td>
	</tr>
	<tr>
	<td colspan="2" class="admin_body"><div align="center">
	<textarea name="description"><?php $textarea = stripslashes($description); echo "$textarea";?></textarea></div>
	</td>
	</tr>
	<tr>
	<td colspan="2" class="admin_body"><input type="hidden" name="ID" value="<?php echo "$id"; ?>">
	<input type="Submit" value="Submit"></form>
	</td>
	</tr>
	</table>
</td>
</tr>
</table>
			
 <?php require_once('footer.php'); ?>	
		