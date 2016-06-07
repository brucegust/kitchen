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

$insert = "insert into classes (name, description) values ('$name', '$description')";
$insertexe = mysqli_query($cxn, $insert);
if(!$insertexe) {
$error = mysqli_errno($cxn).': '.mysqli_error($cxn);
die($error);
} 
require_once('header.php');	
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Class Insert Page</b>
</td>
</tr>
<tr>
<td>
&nbsp;<BR>
</td>
</tr>
<tr>
<td>
Here's the class you just entered. To make any changes, click <A HREF="classes.php">here</a>.
<P>
<?php require_once('help.php'); ?>
</td>
</tr>
<tr>
<td>
	<table width="600" align="center" border="1">
		<tr>
		<td style="background-color:#000000; color:#ffffff; width:200px;">
		Class Name
		</td>
		<td>
		<?php echo $_POST['name']; ?>
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