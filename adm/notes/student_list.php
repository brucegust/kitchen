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
	<b>Student List</b>
	</td>
	</tr>
	<tr>
	<td>&nbsp;<BR>
	</td>
	</tr>
	<tr>
	<td class="MainText">
	<P>
	Below is the list of all the pages that have been entered into the database. To either edit or delete an entry, simply click on one of the two links located at the bottom of each description.
	<br><br>
	<div align="center"><b>To view list of students according to belt, click <A HREF="student_list_belt.php">here</a></b></div>
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
		<table width=100% border="0">
		<tr>
		<td>
		<IMG SRC="../images/spacer.gif" width="10" height="10">
		</td>
		<td class="admin_body">
			<table width="700" class="center" border="1">
			<?php	
			$cur_classname="";
			$querystate = "select s.id, s.first_name, s.last_name, c.name, c.sort_order from students s LEFT OUTER JOIN classes c on s.class=c.name order by c.sort_order, s.last_name";
			$resultstate = mysqli_query($cxn, $querystate);
			if(!$resultstate)
			{
			$nuts=mysqli_errno($cxn).': '.mysqli_error($cxn);
			die($nuts);
			}
			?>
			<tr>
			<td class="admin_body_display" background="../images/spacer.gif" width="550" height="10">
			Name
			</td>
			<td class="admin_body_display">
			Edit / Delete
			</td>
			</tr>
			<?php
			while ($row=mysqli_fetch_assoc($resultstate))
			{
			extract($row);
			?>
			<?php
			if($cur_classname<>$row['name'])
			{
			?>
			<tr>
			<td colspan="2" bgcolor="#cccccc">
			<?php echo stripslashes($row['name']); ?>
			</td>
			</tr>
			<?php
			}
			?>
			<tr>
			<td background="../images/spacer.gif" width="550" height="10">
			<?php echo stripslashes($row['first_name']).' '.stripslashes($row['last_name']); ?>
			</td>
			<td style="text-align:center;">
			<A HREF="student_display.php?ID=<?php echo "$id"; ?>&Edit=Yes">Edit</a>&nbsp;&nbsp
			<A HREF="student_display.php?ID=<?php echo "$id"; ?>&Delete=Yes">Delete
			</td>
			</tr>
			<?php
			$cur_classname=$row['name'];
			}
			?>
			</table>
	<td>
	<IMG SRC="../images/spacer.gif" width="10" height="10">
	</td>	
	</td>
	</tr>
	</table>
</td>
</tr>
</table>

<?php require_once('footer.php'); ?>
