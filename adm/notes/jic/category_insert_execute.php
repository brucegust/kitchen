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

$category = mysqli_real_escape_string($cxn, trim($_POST['category']));
$sub_category = mysqli_real_escape_string($cxn, trim($_POST['sub_category']));
$macro_category_id=trim($_POST['macro_category']);

$sql="select * from macro_categories where id='$macro_category_id'";
$sql_query=mysqli_query($cxn, $sql);
$sql_row=mysqli_fetch_assoc($sql_query);
extract($sql_row);

$insert = "insert into categories (category, sub_category, macro_category_id, macro_category) values ('$category', '$sub_category', '$macro_category_id', '$sql_row[macro_category]')";
//echo $insert;
$insertexe = mysqli_query($cxn, $insert);
if(!$insertexe)
{
	$whoops = mysqli_errno($cxn).' '.mysqli_error($cxn);
	die($whoops);
}
$novie_id = $cxn->insert_id;
if(isset($_FILES['image']) && !empty($_FILES['image']['name']))
{
$photo_presence=1;
require_once('category_photo_insert_script.php');
} 
require_once('header.php');
?>
	

<table border="0" cellspacing="0" cellpadding="0" width="800" class="center">
	<tr>
		<td class="TitleText">
		<b>Category Insert Page</b>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td class="MainText">
		<P>
		Here's the category you just entered into the database. To make any changes, click <A HREF="category_list.php">here</a>, or to add another category, click <A HREF="category_insert.php">here</a>.
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
			<table style="width:auto; margin:auto; background-color:#ffffff; border:1px solid #cccccc; border-radius:10px; padding:10px;" border="0"><form enctype="multipart/form-data" action="category_edit.php" method="post">
				<tr>
					<td>Category Name</td>
					<td><input type="text" size="50" name="category" value="<?php echo $_POST['category'];?>"></td>
				</tr>
				<tr>
					<td>Subcategory Name</td>
					<td><input type="text" size="50" name="category" value="<?php echo $_POST['sub_category'];?>"></td>
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
					<td><br>
					<a href="../assets/images/2010CabinetImages/<?php echo $url;?>" target="_blank">Image</a>
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
	</tr>
</table>
		
 <?php require_once('footer.php'); ?>	
		