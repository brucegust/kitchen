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

$scott="select s.first_name, s.last_name, s.id as student_id, s.rank, c.name, r.rank as belt_name from students s 
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

$francis = "select rank from ranks where id='$rank_id'";
$francis_query=mysqli_query($cxn, $francis);
	if(!$francis_query)
	{
	$nuts=mysqli_errno($cxn).' :'.mysqli_error($cxn);
	die($nuts);
	}
$francis_row=mysqli_fetch_assoc($francis_query);
extract($francis_row);

?>
	
		
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<form name="dfm" action="student_promote_group_execute.php" method="Post">
<tr>
<td class="TitleText">
<b>Student Group Promotion Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td>
Below are the students you just promoted to <b><?php echo stripslashes($francis_row['rank']); ?></b>. If everything looks great, you're done! If you need to make any additional changes, click <A HREF="student_promote.php">here</a> to return to the Student Group Promotion Page,
or click <A HREF="admin.php">here</a> to return to the admin page.
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
	<?php
	$bruce="select id, rank from students where id='$student_id' and rank='$rank_id'";
	$bruce_query=mysqli_query($cxn, $bruce)
	or die("Couldn't execute Bruce.");
	$bruce_count=mysqli_num_rows($bruce_query);
	if($bruce_count>0)
	{
	?>
	<input type="checkbox" value="<?php echo $scott_row['student_id']; ?>" checked name="chkbox_<?php echo $scott_row['student_id']; ?>">
	<?php
	}
	else
	{
	?>
	<input type="checkbox" value="<?php echo $scott_row['student_id']; ?>" name="chkbox_<?php echo $scott_row['student_id']; ?>">
	<?php
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
<input type="hidden" name="class_name" value="<?php echo $class_name; ?>">
<input type="hidden" name="current_rank" value="<?php echo $rank_id; ?>">
</td>
</tr>
</table></form>
		
 <?php require_once('footer.php'); ?>	

