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

$headline = mysqli_real_escape_string($cxn, trim($_POST['name']));

$sort_order=trim($_POST['sort_order']);

$query = "UPDATE ranks SET rank='$headline',
sort_order ='$sort_order'
where id = '$_POST[ID]'";
$result = mysqli_query($cxn, $query);
if (!$result = mysqli_query($cxn, $query)) {
$error = mysql_errno() . mysql_error();
die($error);
}

require_once('header.php');
 
?>

	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Belt Display Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Here's the belt you just edited. To make any addtional changes, click on the "Back" button of your browser and repeat the process. Otherwise, to return to the List of Belts, click <A HREF="rank_list.php">here</a>.
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
	<table width="700" align="center" border="1">
	<tr>
	<td class="MainText" background="../images/spacer.gif" width="200" height="10">
	 <b>Sort Order:</b>
	</td>
	<td background="../images/spacer.gif" width="500" height="10">
	<?php echo "$_POST[sort_order]"; ?>
	</td>
	</tr>
	<tr>
	<td class="MainText" background="../images/spacer.gif" width="200" height="10">
	 <b>Name:</b>
	</td>
	<td background="../images/spacer.gif" width="500" height="10">
	<?php echo "$_POST[name]"; ?>
	</td>
	</tr>
	</table>
</td>
</tr>
</table>
	

 <?php require_once('footer.php'); ?>	
		
