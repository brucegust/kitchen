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
<td class="TitleText">
<b>News Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Below is the list of all the students that have been entered into the database. To either edit or delete an entry, simply click on one of the two buttons located to the right of each name.
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
		<table width="700" align="center" border="1">
		<tr>
		<td bgcolor="#000000">
		<font color="white">Article Date</font>
		</td>
		<td bgcolor="#000000">
		<font color="white">Article Name</font>
		</td>
		<td bgcolor="#000000"align="center">
		<font color="white">Edit / Delete</font>
		</td>
		</tr>
		<?php	
		$querystate = "select * from news order by article_date DESC";
		$resultstate = mysqli_query($cxn, $querystate)
		or die ("Couldn't execute query.");
	
		while ($row=mysqli_fetch_assoc($resultstate))
		{
		extract($row);
		?>
		<tr>
		<td>
		<?php echo date("m/d/y", strtotime($article_date)); ?>
		</td>
		<td background="../images/spacer.gif" width="400" height="10">
			<table cellspacing="0" cellpadding="0">
			<tr>
			<td>
			<?php echo stripslashes($headline); ?>
			</td>
			<td align="right">
			<?php 
			if($featured=="Y"){
			?>
			<IMG SRC="images/white_flag.jpg">
			<?php
			}
			?>
			</td>
			</tr>
			</table>
		</td>
		<td align="center" bgcolor="#cccccc">
		<A HREF="newsdisplay.php?ID=<?php echo "$id"; ?>&Edit=Yes">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<A HREF="newsdisplay.php?ID=<?php echo "$id"; ?>&Delete=Yes">Delete</a>
		</td>
		</tr>
		<?php
		}
		?>
		</table>
</td>
</tr>
</table>

		
	

