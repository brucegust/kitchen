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
			<b>Category List</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td event="MainText">
			<P>
			Below is the list of all the calendar categories that have been entered into the database sorted alphabetically. To either edit or delete an entry, simply click on one of the two links located at the bottom of each description.
			<P>
			<div align="center"><b>If you haven't assigned a sort order to your calendar categories, they are displayed alphabetically.<BR>Otherwise, they'll be displayed according to the sort order you've given them.</b></div>
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
					<table width="700" align="center" border="1" cellspacing="3" cellpadding="3">
					<?php
					$bruce = "select sum(sort_order) as sort_value from calendar_category";
					$bruce_query = mysqli_query($cxn, $bruce);
						if(!$bruce_query){
						$nuts = mysqli_errno($cxn).': '.mysqli_error($cxn);
						die($nuts);
						}
					//here's where I'm determining if there's a sort order
					$bruce_row=mysqli_fetch_assoc($bruce_query);
					extract($bruce_row);
					if(!$bruce_row['sort_value']==0)
					{
					?>
						<?php 
						$michelle = "select * from calendar_category order by sort_order";
						$michelle_query=mysqli_query($cxn, $michelle)
						or die("Michelle didn't work.");
						while($michelle_row=mysqli_fetch_assoc($michelle_query))
						{
						extract($michelle_row);
						?>
						<tr>
						<td>
						<?php echo $michelle_row['sort_order']; ?>
						</td>
						<td background="../images/spacer.gif" width="500" height="10">
						<?php echo stripslashes($michelle_row['name']); ?>
						</td>
						<td bgcolor="#1A0CA4" align="center">
						<A HREF="category_display.php?ID=<?php echo "$id"; ?>&Edit=Yes"><font color="white">Edit</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<A HREF="category_display.php?ID=<?php echo "$id"; ?>&Delete=Yes"><font color="white">Delete</font>
						</td>
						</tr>
						<?php
						}
						?>
					<?php
					}
					else
					{
					?>
						<?php 
						$michelle = "select * from calendar_category order by name";
						$michelle_query=mysqli_query($cxn, $michelle)
						or die("Michelle didn't work.");
						while($michelle_row=mysqli_fetch_assoc($michelle_query))
						{
						extract($michelle_row);
						?>
						<tr>
						<td background="../images/spacer.gif" width="500" height="10">
						<?php echo stripslashes($name); ?>
						</td>
						<td bgcolor="#1A0CA4" align="center">
						<A HREF="category_display.php?ID=<?php echo "$id"; ?>&Edit=Yes"><font color="white">Edit</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<A HREF="category_display.php?ID=<?php echo "$id"; ?>&Delete=Yes"><font color="white">Delete</font>
						</td>
						</tr>
						<?php
						}
						?>
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