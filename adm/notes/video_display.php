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
header("Location: video_delete.php?ID=$ID");
}
else
{

$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");

$query = "select * from videos where id = '$_GET[ID]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
$row = mysqli_fetch_assoc($result);
extract($row);

require_once('header.php');

}

?>

	

<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Video Display Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Here's the video you just selected. Change whatever information you need to alter and then click on "Submit." To return to the Video List, click <A HREF="video_list.php">here</a>.
<P>
<b><font color="red">Remember!</font></b>The only thing you need from the youtube video code is the 11 character code that you see in bold below:
<P>
<div align="center">&lt;iframe width="560" height="315" src="http://www.youtube.com/embed/<b>HAbsSYEJ6wk</b>?rel=0&showinfo=0&autoplay=1&autohide=1" frameborder="0" allowfullscreen&gt;</div>
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
	<table width="700" align="center" border="0"><form action="video_edit.php" method="post">
	<tr>
	<td class="MainText" background="../images/spacer.gif" width="200" height="10">
	Video Name
	</td>
	<td background="../images/spacer.gif" width="500" height="10">
	<input type="text" size="80" name="name" value="<?php $byte=stripslashes($name); echo "$name"; ?>">
	</td>
	</tr>
	<tr>
	<td class="MainText" background="../images/spacer.gif" width="200" height="10">
	Class Name
	</td>
	<td background="../images/spacer.gif" width="500" height="10">
	<select name="class">
	<option selected><?php echo stripslashes($row['class_name']); ?></option>
	<option>Tae Kwon Do</option>
	<option>Jiu Jitsu</option>
	<option>____________________________________________________________________</option>
	</td>
	</tr>
	<td class="MainText" background="../images/spacer.gif" width="200" height="10">
	Age Group
	</td>
	<td background="../images/spacer.gif" width="500" height="10">
	<select name="age">
	<option selected><?php echo stripslashes($row['age']); ?></option>
	<option>Adults</option>
	<option>Students</option>
	<option>____________________________________________________________________</option>
	</td>
	</tr>
	<tr>
	<td>
	Belt
	</td>
	<td>
	<select name="belt">
	<?php
	$bruce="select * from ranks order by sort_order";
	$bruce_query=mysqli_query($cxn, $bruce)
	or die("Couldn't execute Bruce.");
	while($bruce_row=mysqli_fetch_assoc($bruce_query))
	{
	extract($bruce_row);
		if($bruce_row['id']==$row['belt'])
		{
		?>
		<option selected value="<?php echo $bruce_row['id']; ?>"><?php echo stripslashes($bruce_row['rank']); ?></option>
		<?php
		}
		else
		{
		?>
		<option value="<?php echo $bruce_row['id']; ?>"><?php echo stripslashes($bruce_row['rank']); ?></option>
		<?php
		}
	}
	?>
	<option>____________________________________________________________________</option>
	</select>
	</td>
	</tr>
	<tr>
	<td class="MainText">
	Video Code
	</td>
	<td>
	<input type="text" size="80" name="video_code" value="<?php $video_script = html_entity_decode($video_code); echo stripslashes($video_script);?>">
	</td>
	</tr>
	<tr>
	<td colspan="2" style="text-align:center;">&nbsp;<BR>
	<textarea name="description"><?php $textarea = stripslashes($row['description']); echo "$textarea"; ?></textarea>
	</td>
	</tr>
	<tr>
	<td colspan="2" style="text-align:center;"><input type="hidden" name="ID" value="<?php echo $row['id']; ?>"><br>
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
		
