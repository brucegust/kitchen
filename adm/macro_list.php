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
			<b>Category List</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Below is the list of all the macro categories that have been entered into the database. To either edit or delete an entry, simply click on one of the two links located to the right of each macro name.
			<br><br>
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
				
					<table style="width:auto; margin:auto; padding:10px;" border="1">
					<tr>
					<td style="background-color:#000000; color:#ffffff; padding:10px;">
					Macro Category
					</td>
					<td style="background-color:#000000; color:#ffffff; text-align:center; padding:10px;">
					Edit / Delete
					</td>
					</tr>
					<?php
					$querystate = "select * from macro_categories order by macro_category";
					$resultstate = mysqli_query($cxn, $querystate)
					or die ("Couldn't execute query.");
				
					while ($row=mysqli_fetch_assoc($resultstate))
					{
					extract($row);
					?>
					<tr>
						<td style="width:600px; vertical-align:middle; padding:5px;"><?php echo stripslashes($row['macro_category']);?></td>
						<td style="text-align:center; background-color:#cccccc; color:#000000; vertical-align:middle; padding:5px;">
						<A HREF="macro_display.php?ID=<?php echo $row['id']; ?>&Edit=Yes" >Edit</a>&nbsp;&nbsp;
						<A HREF="macro_display.php?ID=<?php echo $row['id']; ?>&Delete=Yes">Delete</a>
						</td>
					</tr>
					<?php
					}
					?>
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