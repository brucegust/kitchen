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
			<td event="TitleText">
			<b>Calendar Category List</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td event="MainText">
			<P>
			Below is the list of all the Calendar Categories that have been entered into the database sorted alphabetically. To either edit or delete an entry, simply click on one of the two links located to the right of each category.
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
					<td bgcolor="#02337b" >
					<font color="white">Sort Order</font>
					</td>
					<td bgcolor="#02337b" >
					<font color="white">Category</font>
					</td>
					<td bgcolor="#02337b" align="center">
					<font color="white">Edit / Delete</font>
					</td>
					</tr>
					<?php
					$bruce = "select * from calendar_category order by sort_order";
					$bruce_query = mysqli_query($cxn, $bruce);
					if(!$bruce_query){
					$nuts = mysqli_errno($cxn).': '.mysqli_error($cxn);
					die($nuts);
					}
					while($bruce_row = mysqli_fetch_assoc($bruce_query))
					{
					extract($bruce_row);
					?>
					<tr>
					<td>
					<?php
					if($sort_order=="" OR $sort_order==" " or empty($sort_order))
					{
					echo "&nbsp;";
					}
					else
					{
					echo $sort_order; 
					}
					?>
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<?php echo stripslashes($category); ?>
					</td>
					<td bgcolor="#02337b" align="center">
					<A HREF="calendar_category_display.php?ID=<?php echo "$id"; ?>&Edit=Yes"><font color="white">Edit</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<A HREF="calendar_category_display.php?ID=<?php echo "$id"; ?>&Delete=Yes"><font color="white">Delete</font>
					</td>
					</tr>
					<?php
					}
					?>
					</table>&nbsp;<BR>
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