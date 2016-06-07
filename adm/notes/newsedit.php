<?php

session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
$photo_presence=0;
$flag=0;
$photo_there=0;
include ("../carter.inc");

$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");

if(!empty($_POST['featured'])){
$flag=1;
//here's where I'm checking to see if the featured box is checked and if it is, I update with a "Y" value
$featured_contestant = "UPDATE news SET featured='Y' where id='$_POST[ID]'";
$featured_contestant_result = mysqli_query($cxn, $featured_contestant);
}
else
{
$flag=0;
//just in case it had been populated before, we go ahead and update it to a null value so we can remove the featured option if need be
$featured_contestant = "UPDATE news SET featured='' where id='$_POST[ID]'";
$featured_contestant_result = mysqli_query($cxn, $featured_contestant);
}


//this is wierd, I know but tinymce is processed by the current set up I have in place in a way where a <br> is added to the default <P> tag, so to compensate for that, I replace the <P>
//with a single <BR> and it works so...

$update =str_replace("<p>", "", $_POST['main_body']); 
$update =str_replace("</p>", "<br />", $update); 

$headline = mysqli_real_escape_string($cxn, trim($_POST['headline']));

$bigstory = mysqli_real_escape_string($cxn, trim($update));

$article_date = date('Y-m-d', strtotime($_POST['article_date']) );

$query = "UPDATE news SET headline='$headline',
main_body='$bigstory',
article_date='$article_date'
where id = '$_POST[ID]'";

$result = mysqli_query($cxn, $query);
if (!$result = mysqli_query($cxn, $query)) {
$error = mysql_errno() . mysql_error();
die($error);
}

if(isset($_FILES['photo']) && !empty($_FILES['photo']['name']))
{
$photo_presence=1;
echo $photo_presence;
require_once('news_photo_edit_script.php');
} 

$bruce= "select photo_one from news where id = '$_POST[ID]'";
$bruce_query=mysqli_query($cxn, $bruce);
$bruce_row=mysqli_fetch_assoc($bruce_query);
extract($bruce_row);
if($bruce_row['photo_one']=="" OR $bruce_row['photo_one']==" " OR empty($bruce_row['photo_one']))
{
$photo_there=0;
}
else
{
$photo_there=1;
}

require_once('header.php');
 
?>


<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Article Display Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Here's the article you just edited. To make any addtional changes, click on the "Back" button of your browser and repeat the process. Otherwise, to return to the Featured News List, click <A HREF="newsList.php">here</a>.
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
		if(!empty($_POST['featured'])){
		?>
		<input type="checkbox" value="Y" name="featured" checked>
		<?php
		}
		else
		{
		?>
		<input type="checkbox" value="Y" name="featured">
		<?php
		}
		?>
		</td>
		</tr>		
		</table>
	</td>
	</tr>
	<tr>
	<td class="MainText" background="../images/spacer.gif" width="200" height="10">
	<b>Headline:</b>
	</td>
	<td background="../images/spacer.gif" width="500" height="10">
		<table cellspacing="0" cellpadding="0">
		<tr>
		<td>
		<?php echo stripslashes($_POST['headline']); ?>
		</td>
		<td>
		<?php 
		if($flag>0){
		?>
		<IMG SRC="images/white_flag.jpg">
		<?php
		}
		?>
		</td>
		</tr>
		</table>
	</td>
	</tr>
	<tr>
	<td class="MainText" background="../images/spacer.gif" width="200" height="10">
	<b>Article Date:</b>
	</td>
	<td background="../images/spacer.gif" width="500" height="10">
	<?php echo date("m/d/y", strtotime($_POST['article_date'])); ?>
	</td>
	</tr>
	<tr>
	<td colspan="2" bgcolor="#CCCCCC">
	<b>Main Body:</b>
	</td>
	</tr>
	<tr>
	<td colspan="2">&nbsp;<BR>
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
			$mainbody=stripslashes($_POST[main_body]);
			echo "$mainbody";
		}
		elseif($photo_there>0)
		{
		?>
			<table cellspacing="3" cellpadding="3" align="left">
			<tr>
			<td width="160">
			<A HREF="../Photos/<?php echo $bruce_row['photo_one']; ?>" target="_blank"><IMG SRC="../Photos/thumbs/<?php echo $bruce_row['photo_one']; ?>" border="0"></a>
			</td>
			</tr>
			</table>
			<?php
			$mainbody=stripslashes($_POST['main_body']);
			echo "$mainbody";
		}
		else
		{
		$mainbody=stripslashes($_POST['main_body']);
		echo "$mainbody";
		}
		?>
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
			
				

