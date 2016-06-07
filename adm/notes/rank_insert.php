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
		<td>
		<td>
		<IMG SRC="../images/spacer.gif" width="10" height="10">
		</td>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" width=100%>
			<tr>
			<td class="TitleText">
			<b>Belt Insert Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			To insert a belt into the database, fill in all of the fields, then click on "Submit."
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
					<table align="center" border="0"><form action="rank_insert_execute.php" method="post">
					<tr>
					<td class="MainText" background="images/spacer.gif" width="100" height="10">
					Sort Order
					</td>
					<td align="center">
					<input type="text" size="70" name="sort_order">
					</td>
					</tr>
					<tr>
					<td class="MainText" background="images/spacer.gif" width="100" height="10">
					Belt Name
					</td>
					<td align="center">
					<input type="text" size="70" name="name">
					</td>
					</tr>
					<tr>
					<td colspan="2" style="text-align:center;"><br>
					<input type="Submit" value="Submit">
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
		</td>
		
		<td>
		<IMG SRC="../images/spacer.gif" width="10" height="10">
		</td>
		</tr>
		</table>
 <?php require_once('footer.php'); ?>	