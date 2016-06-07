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
<b>Picture List</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Below is the list of all the photos that have been entered into the database. To either edit or delete an entry, simply click on one of the two links located at the bottom of each description.
<P>
<div align="center"><b>To insert a photo into one of the web pages, just copy and paste the URL of the photo into the text editor as explained <A HREF="photo_tutorial.pdf" target="_blank">here</a></b></div>
<br>
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
	<td class="admin_body">
		<?php	
		$querystate = "select * from pictures order by name ASC";
		$resultstate = mysqli_query($cxn, $querystate);
		if(!$resultstate)
		{
		$nuts=mysqli_errno($cxn).': '.mysqli_error($cxn);
		die($nuts);
		}
	
		while ($row=mysqli_fetch_assoc($resultstate))
		{
		extract($row);
		?>
		<table width="700" class="center" border="1">
		<tr>
		<td class="admin_body" rowspan="4">
		<IMG SRC="../Photos/thumbs/<?php echo "$url"; ?>" width="75">
		</td>
		<td class="MainText" background="../images/spacer.gif" width="200" height="10">
		<b>Name</b>
		</td>
		<td background="../images/spacer.gif" width="500" height="10" valign="center">
		<A HREF="../Photos/<?php echo "$url"; ?>" target="_blank"><?php $photo=stripslashes($name); echo "$photo"; ?></a>		
		</td>
		</tr>
		<tr>
		<td class="MainText" background="../images/spacer.gif" width="200" height="10">
		<b>URL</b>
		</td>
		<td background="../images/spacer.gif" width="500" height="10" valign="center">
		http//www.rodgerstkd.com/Photos/<?php echo "$url"; ?>	
		</td>
		</tr>
		<tr>
		<td colspan="3">
		<?php
			if(strlen($row['description'])<=175)
		{
		echo stripslashes($row['description']);
		}
		else
		{		
		echo substr(stripslashes($row['description']), 0, 175).'...';
		}		
		?>
		</td>
		</tr>
		<tr>
		<td class="admin_body_display" colspan="3">
		<A HREF="picturedisplay.php?ID=<?php echo "$id"; ?>&Edit=Yes"><font color="white">Edit</font></a>&nbsp;&nbsp;&nbsp;
		<A HREF="picturedisplay.php?ID=<?php echo "$id"; ?>&Delete=Yes"><font color="white">Delete</font>
		</td>
		</tr>
		</table>&nbsp;<BR>
		<?php
		}
		?>
	</td>
	</tr>
	</table>
</td>
</tr>
</table>
	