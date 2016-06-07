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


$category = mysqli_real_escape_string($cxn, trim($_POST['category']));
$sub_category = mysqli_real_escape_string($cxn, trim($_POST['sub_category']));
$macro_category_id=trim($_POST['macro_category']);

$sql="select * from macro_categories where id='$macro_category_id'";
$sql_query=mysqli_query($cxn, $sql);
$sql_row=mysqli_fetch_assoc($sql_query);
extract($sql_row);

$query = "UPDATE categories SET category='$category',
sub_category='$sub_category',
macro_category_id='$macro_category_id',
macro_category='$sql_row[macro_category]'
where id = '$_POST[ID]'";
//echo $query;

//echo $query;

$result = mysqli_query($cxn, $query);
if (!$result = mysqli_query($cxn, $query)) {
$error = mysql_errno() . mysql_error();
die($error);
}

if(isset($_FILES['image']) && !empty($_FILES['image']['name']))
{
	$photo_presence=1;
	echo $photo_presence;
	require_once('category_photo_edit_script.php');
} 

require_once('header.php');
 
?>


<table border="0" cellspacing="0" cellpadding="0" width=100%>
	<tr>
		<td class="TitleText">
		<b>Category Edit Page</b>
		</td>
		</tr>
		<tr>
		<td>&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td class="MainText">
		<P>
		Here's the category you just edited. To make any addtional changes, click on the "Back" button of your browser and repeat the process. Otherwise, to return to the Category List, click <A HREF="category_list.php">here</a>.
		<br><br>
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
			<table style="width:auto; margin:auto; background-color:#ffffff; border:1px solid #cccccc; border-radius:10px; padding:10px;" border="0"><form enctype="multipart/form-data" action="category_edit.php" method="post">
				<tr>
					<td>Category Name</td>
					<td><input type="text" size="50" name="category" value="<?php echo $_POST['category'];?>"></td>
				</tr>
				<tr>
					<td>Subcategory Name</td>
					<td><input type="text" size="50" name="sub_category" value="<?php echo $_POST['sub_category'];?>"></td>
				</tr>
				<tr>
					<td class="MainText">
					 Macro Category
					</td>
					<td>
					<select name="macro_category" style="width:320px;">
					<?php 
					$sql="select * from macro_categories where id='$_POST[macro_category]'";
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
				<?php
					if($photo_presence>0)
					{
					?>
				<tr>
					<td>
					<a href="../assets/images/2010CabinetImages/<?php echo $_POST['image'];?>" target="_blank">Image</a>
					</td>
				</tr>
					<?php
					}
					?>
				<tr>
					<td colspan="2">&nbsp;<br></td>
				</tr>
				</table>
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
			
				

