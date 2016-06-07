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
			<b>Testimonial List</b>
			</td>
			</tr>
			<tr>
			<td>&nbsp;<BR>
			</td>
			</tr>
			<tr>
			<td class="MainText">
			<P>
			Below is the list of all the quotes that have been entered into the database. To either edit or delete an entry, simply click on one of the two links located at the bottom of each description.
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
			<td style="text-align:center;">
				<table border="0" style="margin:auto; width:800px;">
				<tr>
				<td>
				<IMG SRC="../images/spacer.gif" width="10" height="10">
				</td>
				<td style="text-align:center;">
				
					<?php	
					$querystate = "select * from quotes order by author";
					$resultstate = mysqli_query($cxn, $querystate)
					or die ("Couldn't execute query.");
				
					while ($row=mysqli_fetch_assoc($resultstate))
					{
					extract($row);
					?>
					<table width="700" style="text-align:center;" border="1">
					<tr>
					<td class="MainText" background="../images/spacer.gif" width="100" height="10">
					<b>Author:</b>
					</td>
					<td background="../images/spacer.gif" width="500" height="25">
					<?php echo "$author"; ?><?php if($featured=="Y"){ ?><IMG SRC="images/white_flag.jpg" style="vertical-align:middle"><?php } else {?> <IMG SRC="images/spacer.gif" height="25" width="25" style="vertical-align:middle"><?php } ?>
					</td>
					</tr>
					<tr>
					<td colspan="2" bgcolor="#CCCCCC">
					<b>Testimonial:</b>
					</td>
					</tr>
					<tr>
					<td colspan="2">
					<?php 
					echo nl2br(stripslashes($quote)); 
					?>
					</td>
					</tr>
					<tr>
					<td style="text-align:center;" bgcolor="#002d56" colspan="3">
					<A HREF="quotedisplay.php?ID=<?php echo "$id"; ?>&Edit=Yes"><font color="white">Edit</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<A HREF="quotedisplay.php?ID=<?php echo "$id"; ?>&Delete=Yes"><font color="white">Delete</font>
					</td>
					</tr>
					<tr>
					<td style="text-align:center;" bgcolor="#002d56" colspan="3">
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


