<?php
session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
include ("../carter.inc");

require_once('header.php');
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Macro Category Insert Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
To insert a Macro Category, fill in the "name" field below and click on "Submit." To return to the List of Macro Categories, click <A HREF="macro_list.php">here</a>.
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
	<table class="center" border="1"><form action="macro_insert_execute.php" method="post">
		<tr>
		<td class="MainText" background="images/spacer.gif" width="100" height="10">
		 Name
		</td>
		<td>
		<input type="text" size="45" name="macro_category">
		</td>
		</tr>
		<tr>
		<td colspan="2" class="admin_body" style="padding:10px; vertical-align:middle;"><input type="Submit" value="Submit">
		</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
		
 <?php require_once('footer.php'); ?>	
		