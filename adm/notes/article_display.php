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
header("Location: article_delete.php?ID=$ID");
}
else
{
$doc=0;
$web=0;
$video=0;
$plain_text=0;
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$query = "select * from articles where id = '$_GET[ID]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
$row = mysqli_fetch_assoc($result);
extract($row);
if($article_type=="document")
{
$doc=1;
}
if($article_type=="website")
{
$web=1;
}
if($article_type=="video")
{
$video=1;
}
if($article_type=="plain_text")
{
$plain_text=1;
}
}
require_once('header.php');
?>
	

<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Article Display</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
<?php
if($article_type=="plain_text")
{
?>
Here's the <b>plain text article</b> you just selected. Change whatever information you need to alter and then click on "Submit." To return to the List of Articles, click <A HREF="article_list.php">here</a>.
<?php
}
else
{
?>
Here's the <b><?php echo $article_type; ?> article</b> you just selected. Change whatever information you need to alter and then click on "Submit." To return to the List of Articles, click <A HREF="article_list.php">here</a>.
<?php
}
?>
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
	<?php
	if($doc>0)
	{
	require_once('display_script_doc.php');
	}
	?>
	<?php
	if($web>0)
	{
	require_once('display_script_web.php');
	}
	?>
	<?php
	if($video>0)
	{
	require_once('display_script_video.php');
	}
	?>
	<?php
	if($plain_text>0)
	{
	require_once('display_script_plain_text.php');
	}
	?>
	
</td>
</tr>
</table>
			

 <?php require_once('footer.php'); ?>	
		