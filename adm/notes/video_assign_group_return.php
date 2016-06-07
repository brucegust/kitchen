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

$rank_id=$_GET['rank_id'];
$class_name = $_GET['class_name'];
$video_id=$_GET['video_id'];

$scott="select s.first_name, s.last_name, s.id, s.rank, c.name, r.rank as belt_name from students s 
LEFT OUTER JOIN classes c on (s.class=c.name or s.class_two=c.name) 
INNER JOIN ranks r on r.id = s.rank
where (s.rank = '$rank_id' or s.rank_two='$rank_id') and (s.class='$class_name' or s.class_two='$class_name')
order by s.last_name";
$scott_query=mysqli_query($cxn, $scott);
if(!$scott_query)
{
$drag=mysqli_errno($cxn).': '.mysqli_error($cxn);
die($drag);
}
$scott_count=mysqli_num_rows($scott_query);

$field_count=1;

$jorja="select v.name, v.belt, v.id, r.rank from videos v INNER JOIN ranks r on v.belt=r.id where v.id='$video_id'";
$jorja_query=mysqli_query($cxn, $jorja);
	if(!$jorja_query)
	{
	$nuts=mysqli_errno($cxn).': '.mysqli_error($cxn);
	die($nuts);
	}
$jorja_row=mysqli_fetch_assoc($jorja_query);
extract($jorja_row);

?>
	
		
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<form name="dfm" action="video_assign_group_execute.php" method="Post">
<tr>
<td class="TitleText">
<b>Video Group Assign Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
These are the students who you have authorized to view the <b><?php echo stripslashes($jorja_row['name']).' | '.stripslashes($jorja_row['rank']); ?></b>.
<br><br>
If everything looks good, you're done. If you need to make any changes, simply make your adjustments and click on the "submit" button below.

</td>
</tr>
<tr>
<td><br>
To return to the admin page, click <A HREF="admin.php">here</a>. To return to the Group Video Select Page, click <A HREF="video_assign_group.php">here</a>.
<P>
If you need any help of have any questions, contact Bruce Gust at <A HREF="mailto:bruce@brucegust.com">bruce@brucegust.com</a>
<P>
Thanks!
</td>
</tr>
<tr>
<td style="text-align:right">
<!--<a href="#" class="select_all" onclick='select_all(dfm, "<?php echo $scott_count; ?>")'>select all</a>&nbsp;<a href="#" class="select_all" onclick='clear_all(dfm, "<?php echo $scott_count; ?>")'>clear all</a>-->
select all / clear all &nbsp; <input id="checkAllCheckBox" type="checkbox" />
</td>
</tr>
<tr>
<td>
	<table width="100%" border="1" class="tableClass">
	<tr>
	<td class="black">
	<div align="center">select</div>
	</td>
	<td class="black">
	<div align="center">Last Name</div>
	</td>
	<td class="black">
	<div align="center">First Name</div>
	</td>
	<td class="black">
	<div align="center">Current Belt</div>
	</td>
	</tr>
	<?php
	while($scott_row=mysqli_fetch_assoc($scott_query))
	{
	extract($scott_row);
	?>
	<tr>
	<td style="text-align:center;">
	<?php if(isset($_GET['video_id']))
	{
	$suzi="select id from video_assign where video_id='$_GET[video_id]' and student_id='$scott_row[id]'";
	$suzi_query=mysqli_query($cxn, $suzi)
	or die("Couldnt' make Suzi happen.");
	$suzi_count=mysqli_num_rows($suzi_query);
		if($suzi_count>0)
		{
		?>
		<input type="checkbox" value="<?php echo $scott_row['id']; ?>" checked name="chkbox_<?php echo $scott_row['id']; ?>">
		<?php
		}
		else
		{
		?>
		<input type="checkbox" value="<?php echo $scott_row['id']; ?>" name="chkbox_<?php echo $scott_row['id']; ?>">
		<?php
		}
	}
	else
	{
		$bruce="select id from video_assign where video_id='$video_id' and student_id='$scott_row[id]'";
		$bruce_query=mysqli_query($cxn, $bruce)
		or die("Couldn't execute Bruce.");
		$bruce_count=mysqli_num_rows($bruce_query);
		if($bruce_count>0)
		{
		?>
		<input type="checkbox" value="<?php echo $scott_row['id']; ?>" checked name="chkbox_<?php echo $scott_row['id']; ?>">
		<?php
		}
		else
		{
		?>
		<input type="checkbox" value="<?php echo $scott_row['id']; ?>" name="chkbox_<?php echo $scott_row['id']; ?>">
		<?php
		}
	}
	?>
	</td>
	<td>
	&nbsp;<?php echo stripslashes($scott_row['last_name']); ?>
	</td>
	<td>
	&nbsp;<?php echo stripslashes($scott_row['first_name']); ?>
	</td>
	<td>
	&nbsp;<?php echo stripslashes($scott_row['belt_name']); ?>
	</td>
	</tr>
	<?php
	$field_count=$field_count+1;
	}
	?>
	</table>
</td>
</tr>
<tr>
<td style="text-align:center;"><br>
<input type="hidden" name="field_count" value="<?php echo $field_count; ?>">
<input type="hidden" name="rank" value="<?php echo $rank_id; ?>">
<input type="hidden" name="video_id" value="<?php echo $video_id; ?>">
<input type="hidden" name="class_name" value="<?php echo $class_name; ?>">
<input type="submit" value="submit">
</td>
</tr>
</table></form>
		
 <?php require_once('footer.php'); ?>	

