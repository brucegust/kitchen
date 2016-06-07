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
<b>Article List</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Below is the list of all the articles that have been entered into the database. To either edit or delete an entry, simply click on one of the two links located at the bottom of each description.
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
	<table width=100% border="0" class="center">
	<tr>
	<td class="admin_body">
		<?php	
		$querystate = "select * from articles order by page_name";
		$resultstate = mysqli_query($cxn, $querystate)
		or die ("Couldn't execute query.");
	
		while ($row=mysqli_fetch_assoc($resultstate))
		{
		extract($row);
		if($article_type=="plain_text")
		{
		$the_article_type="plain text";
		}
		else
		{
		$the_article_type = stripslashes($article_type);
		}
		?>
		<table width="700" class="center" border="1">
		<tr>
		<td class="MainText" background="../images/spacer.gif" width="150" height="10">
		<b>Article Name:</b>
		</td>
		<td class="article_display"><?php if(empty($retired)){ echo stripslashes($page_name).'  ('.$the_article_type.')'; } else { echo stripslashes($page_name).'  ('.$the_article_type.')'; ?>
		<font color="red" size="2">&nbsp;(retired)</font><?php } ?>&nbsp; <?php if($featured=="Y"){ ?><IMG SRC="images/white_flag.jpg" style="vertical-align:middle"><?php } else {?> <IMG SRC="images/spacer.gif" height="25" width="25" style="vertical-align:middle"><?php } ?>
		</td>
		</tr>
		<tr>
		<td class="admin_body_display" colspan="3">
		<A HREF="article_display.php?ID=<?php echo "$id"; ?>&Edit=Yes"><font color="white">Edit</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<A HREF="article_display.php?ID=<?php echo "$id"; ?>&Delete=Yes"><font color="white">Delete</font>
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
		