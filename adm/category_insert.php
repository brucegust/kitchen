<?php
session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
include ("../carter.inc");

require_once('header.php');
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
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
To insert a new category into the database, fill in the fields below and click on "submit." To return to the List of Categories, click <A HREF="category_list.php">here</a>, to return to the admin page, click <a href="admin.php">here</a>.
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
<form enctype="multipart/form-data" action="category_insert_execute.php" method="post">
	<table style="width:auto; margin:auto; background-color:#ffffff; border:1px solid #cccccc; border-radius:10px; padding:10px;" border="0">
		<tr>
			<td>Category Name</td>
			<td><input type="text" size="50" name="category"></td>
		</tr>
		<tr>
			<td>Subcategory Name</td>
			<td><input type="text" size="50" name="sub_category"></td>
		</tr>
		<tr>
			<td class="MainText">
			 Macro Category
			</td>
			<td>
			<select name="macro_category" style="width:320px;">
			<option></option>
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
			Image
			</td>
			<td><input type="file" name="image" size="36"></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;<br></td>
		</tr>
		<tr>
		<td colspan="2" class="admin_body"><input type="hidden" name="ID" value="<?php echo "$id"; ?>">
		<input type="Submit" value="Submit">
		</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
		
 <?php require_once('footer.php'); ?>	
		