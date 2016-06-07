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

$rank = mysqli_real_escape_string($cxn, trim($_POST['name']));

$sort_order=trim($_POST["sort_order"]);

$insert = "insert into ranks (sort_order, rank)
values ('$sort_order', '$rank')";
$insertexe = mysqli_query($cxn, $insert)
or die ("Couldn't execute query.");

require_once('header.php');

?>
	

<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Belt Insert </b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Here's the belt you just entered into the database. To make any changes, click <A HREF="rank_list.php">here</a>.
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
	<table width=100% border="0">
	<tr>
	<td>
	<IMG SRC="../images/spacer.gif" width="10" height="10">
	</td>
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
		<b>Belt Name:</b>
		</td>
		<td background="../images/spacer.gif" width="500" height="10">
		<?php echo "$_POST[name]"; ?>
		</td>
		</tr>
		</table>

	</td>
	<td>
	<IMG SRC="../images/spacer.gif" width="10" height="10">
	</td>
	</tr>
	</table>
</td>
</tr>
</table>
		

 <?php require_once('footer.php'); ?>	
		
