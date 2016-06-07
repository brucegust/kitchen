<?php

session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}

include ("../carter.inc");

if (!is_numeric($_GET['id'])) 
{ 
// id's not numeric?  
// kill the script before the query can run 
die("The id must be numeric!"); 
} 

$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");

$mccoy="select repeating_event_id from calendar where id='$_GET[id]'";
$mccoy_query=mysqli_query($cxn, $mccoy)
or die("Couldn't handle the mccoy");
$mccoy_row=mysqli_fetch_assoc($mccoy_query);
extract($mccoy_row);

$query = "delete from calendar where repeating_event_id='$_GET[repeating_id]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");

include('return_script_get.php');

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
<HR>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td align="center">
	<table width="800" align="center" border="0" cellspacing="1" cellpadding="1">
	<tr>
	<td>	
	Congratulations! You have successfully deleted your selection from the database. Click <A HREF="<?php echo $return_back_page; ?>">here</a> to return to the Calendar List.
	<P>
	<?php include ("help.php"); ?>
	</td>
	</tr>
	<td>&nbsp;<BR>
	</td>
	</tr>
	</table>
</td>
</tr>
</table>


 <?php require_once('footer.php'); ?>		
