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
			<b>Page List</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Below is the list of all the pages that have been entered into the database. To either edit or delete an entry, simply click on one of the two links located at the bottom of each description.
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
				<table width=100% border="0">
				<tr>
				<td>
				<IMG SRC="../images/spacer.gif" width="10" height="10">
				</td>
				<td class="admin_body">
				
					<?php	
					$querystate = "select * from pages order by page_name";
					$resultstate = mysqli_query($cxn, $querystate)
					or die ("Couldn't execute query.");
				
					while ($row=mysqli_fetch_assoc($resultstate))
					{
					extract($row);
					?>
					<table width="700" class="center" border="1">
					<tr>
					<td class="MainText" background="../images/spacer.gif" width="100" height="10">
					<b>Page Name:</b>
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<?php echo "$page_name"; ?>
					</td>
					</tr>
					<tr>
					<td class="admin_body_display" colspan="2">
					<A HREF="pagedisplay.php?ID=<?php echo "$id"; ?>&Edit=Yes"><font color="white">Edit</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<A HREF="pagedisplay.php?ID=<?php echo "$id"; ?>&Delete=Yes"><font color="white">Delete</font>
					</td>
					</tr>
					</table>&nbsp;<BR>
				
					<?php
					}
					?>
					
						
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