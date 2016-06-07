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
To insert a class, fill in the fields below and click on "submit."
<P>
<?php require_once('help.php'); ?>
</td>
</tr>
<tr>
<td>
	<table width="825" align="center" border="0"><form  action="classes_insert_execute.php" method="POST">
	<tr>
	<td class="black">
	Class Name
	</td>
	<td>
	<input type="text" size="105" name="name">
	</td>
	</tr>
	<tr>
	<td colspan="2"><br>
	<div align="center"><textarea class="comments" name="description"></textarea></div>
	</td>
	</tr>
	</table>
</td>
</tr>
<tr>
<td align="center"><BR>
<div align="center"><input type="submit" value="submit"></div></form>
</td>
</tr>
</table>

		
 <?php require_once('footer.php'); ?>	