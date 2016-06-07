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
			<table border="0" cellspacing="0" cellpadding="0" width="700" align="center">
			<tr>
			<td class="TitleText">
			<b>Calendar Design List</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Below is the list of all the months that have been entered into the database. To either edit or delete an entry, simply click on one of the two links located to the right of each month. 
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
			<td align="center" valign="top">
				<table width=100% border="0">
				<tr>
				<td>
				<IMG SRC="../images/spacer.gif" width="10" height="10">
				</td>
				<td align="center">
					<table width="800" border="1" align="center" cellspacing="2" cellpadding="2">
					<tr>
					<td bgcolor="#cccccc" align="center" background="../images/spacer.gif" width="600" height="10">
					<b>Month</b>
					</td>									
					<td bgcolor="#cccccc" align="center">
					<b>Edit / Delete</b>
					</td>
					</tr>
					<?php	
					$querystate = "select distinct year from calendar_design order by year";
					$resultstate = mysqli_query($cxn, $querystate)
					or die ("Couldn't execute query.");
					while ($row=mysqli_fetch_assoc($resultstate))
					{
					extract($row);
					?>
					<tr>
					<td colspan="3" bgcolor="blue">
					<font color="white"><?php echo $year; ?></font>
					</td>
					</tr>
					<?php
					$bruce="select * from calendar_design where year = '$row[year]' order by month_number";
					$bruce_query = mysqli_query($cxn, $bruce);
					if(!$bruce_query)
					{
					$rats=mysqli_errno($cxn).': '.mysqli_error($cxn);
					die($rats);
					}
					while($bruce_row = mysqli_fetch_assoc($bruce_query))
					{
					extract($bruce_row);
					?>
					<tr>
					<td>
					<?php echo stripslashes($bruce_row['month']); ?>
					</td>
					<td align="center" bgcolor="#cccccc">
					<A HREF="cal_design_display.php?ID=<?php echo "$id"; ?>&Edit=Yes">Edit</a>&nbsp;&nbsp;
					<A HREF="cal_design_display.php?ID=<?php echo "$id"; ?>&Delete=Yes">Delete</a>
					</td>
					</tr>
					<?php
					}
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
 <?php require_once('footer.php'); ?>	