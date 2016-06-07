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
			<b>Event List</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td event="MainText">
			<P>
			Below is the list of all the special events that have been entered into the database sorted by date. To either edit or delete an entry, simply click on one of the two links located at the bottom of each description.
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
						<?php
					$bruce = "select * from event order by event_date";
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
					<td background="../images/spacer.gif" width="500" height="10">
					<?php echo stripslashes($event_name); ?>
					</td>
					<td bgcolor="#02337b" style="text-align:center;">
					<A HREF="event_display.php?ID=<?php echo "$id"; ?>&Edit=Yes"><font color="white">Edit</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<A HREF="event_display.php?ID=<?php echo "$id"; ?>&Delete=Yes"><font color="white">Delete</font>
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