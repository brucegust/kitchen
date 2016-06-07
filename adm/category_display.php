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
header("Location: category_delete.php?ID=$ID");
}
else
{
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$query = "select * from categories where id = '$_GET[ID]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
$row = mysqli_fetch_assoc($result);
extract($row);
}
require_once('header.php');
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Category Display</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Here's the category you just selected. Change whatever information you need to alter and then click on "Submit." To return to the List of Categories, click <A HREF="category_list.php">here</a>.
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
	<table style="width:auto; margin:auto; background-color:#ffffff; border:1px solid #cccccc; border-radius:10px; padding:10px;" border="0"><form enctype="multipart/form-data" action="category_edit.php" method="post">
		<tr>
			<td>Category Name</td>
			<td><input type="text" size="50" name="category" value="<?php echo stripslashes($row['category']);?>"></td>
		</tr>
		<tr>
			<td>Subcategory Name</td>
			<td><input type="text" size="50" name="sub_category" value="<?php echo stripslashes($row['sub_category']);?>"></td>
		</tr>
		<tr>
			<td class="MainText">
			 Macro Category
			</td>
			<td>
			<select name="macro_category" style="width:320px;">
			<?php 
			$sql="select * from macro_categories where id='$row[macro_category_id]'";
			$sql_query=mysqli_query($cxn, $sql);
			$sql_row=mysqli_fetch_assoc($sql_query);
			extract($sql_row);
			?>
			<option value="<?php echo $sql_row['id'];?>" selected><?php echo stripslashes($sql_row['macro_category']);?></option>
			<?php
			$michelle="select * from macro_categories order by macro_category";
			$michelle_query=mysqli_query($cxn, $michelle)
			or die("Macro Category query failed");
			while($michelle_row=mysqli_fetch_assoc($michelle_query))
			{
			?>
			<option value="<?php echo $michelle_row['id'];?>"><?php echo stripslashes($michelle_row['macro_category']);?></option>
			<?php
			}
			?>
			</select>
			</td>
		</tr>
		<tr>
			<td>
			<?php
			if($row['image_path']<>"")
			{
			?>
			<a href="../<?php echo $row['image_path'];?>" target="_blank">Image</a>
			<?php
			}
			else
			{
			?>
			Image
			<?php
			}
			?>
			</td>
			<td><input type="file" name="image" size="36"></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;<br></td>
		</tr>
		<tr>
		<td colspan="2" class="admin_body"><input type="hidden" name="ID" value="<?php echo $row['id']; ?>">
		<input type="Submit" value="Submit">
		</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
		
 <?php require_once('footer.php'); ?>	
		