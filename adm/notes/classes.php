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
<b>Classes Page</b>
</td>
</tr>
<tr>
<td>
&nbsp;<BR>
</td>
</tr>
<tr>
<td>
Below is a list off all classes in the "Rodgers TKD Academy" family. To edit or delete an entry, click on the link to the right of their name in the Edit / Delete column
<P>
<?php require_once('help.php'); ?>
</td>
</tr>
<tr>
<td style="text-align:center;">
	<table width="600" border="1" align="center">
	<tr>
	<td class="black">
	Class Name
	</td>
	<td class="black" background="images/spacer.gif" width="150" height="10" align="center">
	<div align="center">Edit / Delete</div>
	</td>
	</tr>
	<?php
	$tammy = "select * from classes order by sort_order";
	$tammy_query=mysqli_query($cxn, $tammy);
	if(!$tammy_query)
	{
	$nuts=mysqli_errno($cxn).': '.mysqli_error($cxn);
	die($nuts);
	}
	while($tammy_row=mysqli_fetch_assoc($tammy_query))
	{
	extract($tammy_row);
	?>
	<tr>
	<td>
	<?php echo stripslashes($tammy_row['name']); ?>
	</td>
	<td class="top_header">
	<A HREF="classes_display.php?id=<?php echo $tammy_row['id']; ?>&Edit=Yes">Edit</a>&nbsp;&nbsp;&nbsp;<A HREF="classes_display.php?id=<?php echo $tammy_row['id']; ?>&Delete=Yes">Delete</a>
	</td>
	</tr>
	<?php 
	}
	?>
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