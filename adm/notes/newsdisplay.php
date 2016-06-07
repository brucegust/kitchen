<?php
session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
include ("../carter.inc");
if ($_GET['Edit'] != "Yes")
{
$ID=$_GET[ID];
header("Location: newsdelete.php?ID=$ID");
}
else
{
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$photo_presence=0;
$query = "select * from news where id = '$_GET[ID]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
$row = mysqli_fetch_assoc($result);
extract($row);
if($photo_one=="" OR $photo_one==" " OR empty($photo_one))
{
$photo_presence=0;
}
else
{
$photo_presence=1;
}
}
require_once('header.php');
?>
	

<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Featured Student Display Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Here's the student you just selected. Change whatever information you need to alter and then click on "Submit." To return to the Student List, click <A HREF="newsList.php">here</a>.
<P>
If "Photo One" is an active link, that means there's a photo attached to this article and you can view the photo by clicking on the link.
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
	<table width="700" class="center" border="0"><form enctype="multipart/form-data" action="newsedit.php" method="post">
	<tr>
	<td bgcolor="#cccccc" colspan="2">
		<table width=100% bgcolor="#cccccc">
		<tr>
		<td>
		<IMG SRC="images/spacer.gif" width="500" height="10">
		</td>
		<td align="right">
		Featured Article
		&nbsp;
		<?php 
		if(empty($featured)){
		?>
		<input type="checkbox" value="Y" name="featured">
		<?php
		}
		else
		{
		?>
		<input type="checkbox" value="Y" name="featured" checked>
		<?php
		}
		?>
		</td>
		</tr>		
		</table>
	</td>
	</tr>
	<tr>
	<td colspan="2">
	&nbsp;<BR>
	</td>
	</tr>
	<tr>
	<td class="MainText" background="../images/spacer.gif" width="200" height="10">
	<?php
	if($photo_presence>0)
	{
	?>
	<A HREF="../Photos/news/<?php echo $photo_one; ?>" target="_blank">Photo One</a>
	<?php
	}
	else
	{
	?>
	Photo One
	<?php
	}
	?>
	</td>
	<td>
	<input name="photo" type="file" size="66">
	</td>
	</tr>
	<tr>
	<td class="MainText" background="../images/spacer.gif" width="200" height="10">
	Name
	</td>
	<td background="../images/spacer.gif" width="500" height="10">
	<input type="text" size="80" name="headline" value="<?php echo stripslashes($headline); ?>">
	</td>
	</tr>
	<tr>
	<td class="MainText" background="../images/spacer.gif" width="200" height="10" rowspan="2">
	Article Date
	</td>
	<td background="../images/spacer.gif" width="500" height="10">
	<input type="text" size="80" name="article_date" value="<?php echo "$article_date"; ?>">
	</td>
	</tr>
	<tr>
	<td>
	<b><font size="1">...be sure to enter your date as "yyyy-mm-dd."</b></font>
	<tr>
	<td colspan="2">&nbsp;<BR>
	<textarea name="main_body"><?php echo stripslashes(nl2br($main_body)); ?>
	</textarea>
	</td>
	</tr>
	<tr>
	<td colspan="2" class="admin_body"><input type="hidden" name="ID" value="<?php echo "$id"; ?>">
	<input type="Submit" value="Submit">
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
		