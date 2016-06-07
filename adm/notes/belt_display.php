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
$ID=$_GET['id'];
header("Location: belt_delete.php?ID=$ID");
}
else
{
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$query = "select * from black_belt where id = '$_GET[id]'";
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
<b>Black Belt Display</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Here's the black belt you just selected. Change whatever information you need to alter and then click on "Submit." To return to the List of Black Belts, click <A HREF="belt_list.php">here</a>.
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
<td class="MainText">
	<table align="center" border="0"><form action="belt_edit.php" method="post">
	<tr>
	<td class="MainText">
	First Name
	</td>
	<td>
	<input type="text" size="78" name="first_name" value="<?php echo stripslashes($row['first_name']); ?>">
	</td>
	</tr>
	<tr>
	<td class="MainText">
	Last Name
	</td>
	<td>
	<input type="text" size="78" name="last_name" value="<?php echo stripslashes($row['last_name']); ?>">
	</td>
	</tr>
	<tr>
	<td class="MainText">
	Belt / Rank
	</td>
	<td>
	<select name="belt">
	<?php
	$suzi="select * from ranks where sort_order='$row[belt_sort_order]'";
	$suzi_query=mysqli_query($cxn, $suzi)
	or die("Suzi didn't work!");
	$suzi_row=mysqli_fetch_assoc($suzi_query);
	extract($suzi_row);
	?>
	<option selected><?php echo stripslashes($suzi_row['rank']); ?></option>
	<?php 
	$bruce="select * from ranks order by sort_order";
	$bruce_query=mysqli_query($cxn, $bruce);
	while($bruce_row=mysqli_fetch_assoc($bruce_query))
	{
	extract($bruce_row);
	?>
	<option><?php echo stripslashes($rank); ?></option>
	<?php
	}
	?>
	<option>___________________________________________________________________</option>
	</select>
	</td>
	</tr>
	<tr>
	<td colspan="2" class="admin_body"><input type="hidden" name="id" value="<?php echo $row['id']; ?>"><BR>
	<input type="Submit" value="Submit">
	</td>
	</tr>
	</table>
</td>
</tr>
</table>
				
		
	
 <?php require_once('footer.php'); ?>	