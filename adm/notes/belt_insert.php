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
			<b>Black Belt Insert Page</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			To insert a black belt into the database, fill in all of the fields, then click on "Submit."
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
					<table align="center" border="0"><form action="belt_insert_execute.php" method="post">
					<tr>
					<td class="MainText">
					First Name
					</td>
					<td>
					<input type="text" size="78" name="first_name">
					</td>
					</tr>
					<tr>
					<td class="MainText">
					Last Name
					</td>
					<td>
					<input type="text" size="78" name="last_name">
					</td>
					</tr>
					<tr>
					<td class="MainText">
					Belt / Rank
					</td>
					<td>
					<select name="belt">
					<option></option>
					<?php 
					$bruce="select * from ranks order by sort_order";
					$bruce_query=mysqli_query($cxn, $bruce);
					while($bruce_row=mysqli_fetch_assoc($bruce_query))
					{
					extract($bruce_row);
					?>
					<option><?php echo stripslashes($rank); ?></option>
					<?php
					}
					?>
					<option>___________________________________________________________________</option>
					</select>
					</td>
					</tr>
					<tr>
					<td colspan="2" class="admin_body"><BR>
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