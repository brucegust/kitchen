<?php
session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
$photo_presence=0;
include ("../carter.inc");
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$headline = mysqli_real_escape_string($cxn, trim($_POST['headline']));
//this is to compensate for the way tinymce introduces <P> tags...
$update =str_replace("<p>", "", $_POST['main_body']); 
$update =str_replace("</p>", "<br />", $update); 
$bigstory = mysqli_real_escape_string($cxn, trim($update));
$article_date = date('Y-m-d',strtotime($_POST['month'].' '.$_POST['day'].' '.$_POST['year']));
$display_date = date('F j, Y', strtotime($_POST['month'].' '.$_POST['day'].' '.$_POST['year']));
$insert = "insert into news (headline, article_date, main_body)
values ('$headline', '$article_date', '$bigstory')";
$insertexe = mysqli_query($cxn, $insert)
or die ("Couldn't execute query.");
$novie_id = $cxn->insert_id;
if(isset($_FILES['photo']) && !empty($_FILES['photo']['name']))
{
$photo_presence=1;
require_once('news_photo_insert_script.php');
} 
require_once('header.php');
?>
	

<table border="0" cellspacing="0" cellpadding="0" width="800" class="center">
<tr>
<td class="TitleText">
<b>Featured Student Insert Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Here's the student you just entered into the database. To make any changes, click <A HREF="newsList.php">here</a>, or to add another student, click <A HREF="newsInsert.php">here</a>.
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
	<table width="700" class="center" border="0">
	<tr>
	<td class="MainText">
	<?php echo $display_date; ?>
	</td>
	</tr>
	<tr>
	<td align="center">
	<b><?php echo "$_POST[headline]"; ?></b>&nbsp;<BR>&nbsp;<BR>
	</td>
	</tr>
	<tr>
	<td>
	<?php 
	if($photo_presence>0)
	{
	?>
	<table cellspacing="3" cellpadding="3" align="left">
	<tr>
	<td width="160">
	<A HREF="../Photos/<?php echo $url; ?>" target="_blank"><IMG SRC="../Photos/thumbs/<?php echo $url; ?>" border="0"></a>
	</td>
	</tr>
	</table>
	<?php
	echo nl2br(stripslashes($_POST['main_body']));
	}
	else
	{
	echo nl2br(stripslashes($_POST['main_body']));
	}
	?>
	</td>
	</tr>
	</table>
</td>
</tr>
</table>
		
 <?php require_once('footer.php'); ?>	
		