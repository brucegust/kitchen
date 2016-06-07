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
header("Location: product_delete.php?ID=$ID");
}
else
{
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$photo_presence=0;
$query = "select * from products where id = '$_GET[ID]'";
$result = mysqli_query($cxn, $query)
or die ("Couldn't execute query.");
$row = mysqli_fetch_assoc($result);
extract($row);
if($image1=="" OR $image1==" " OR empty($image1))
{
$photo_presence=0;
}
else
{
$photo_presence=1;
}
}
require_once('header.php');
?>
	
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
<td class="TitleText">
<b>Product Display Page</b>
</td>
</tr>
<tr>
<td class="MainText">
<br><br>
Here's the product you just selected. Make your changes and then click on "submit" at the bottom of the screen.
<br><br>
To return to the Product List, click <a href="product_list.php">here</a>.
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
<td class="admin_body">
	<table width=100% border="0">
	<tr>
	<td>
	<IMG SRC="../images/spacer.gif" width="10" height="10">
	</td>
	<td class="admin_body">	
		<table width="700" class="center" border="0"><form enctype="multipart/form-data" action="product_edit.php" method="post">
		<tr>
			<td style="background-color:#cccccc; text-align:right;" colspan="2">
				<table align="right">
					<tr>
						<td>
						<IMG SRC="images/spacer.gif" height="10">
						</td>
						<td align="right">
						Hidden
						&nbsp;
						</td>
						<td>
						<?php 
						if(empty($hidden)){
						?>
						<input type="checkbox" value="Y" name="hidden">
						<?php
						}
						else
						{
						?>
						<input type="checkbox" value="Y" name="hidden" checked>
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
				<?php
				if($photo_presence>0)
				{
				?>
				<A HREF="../assets/images/<?php echo $image1; ?>" target="_blank">Photo</a>
				<?php
				}
				else
				{
				?>
				Photo
				<?php
				}
				?>
				</td>
				<td>
				<input name="photo" type="file" size="66">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Name
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="name" value="<?php echo stripslashes($row['name']); ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Part ID
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="part_id" value="<?php echo stripslashes($row['part_id']); ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Category
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
					<select name="categories">
					<option></option>
					<?php 
					$sql="select * from categories order by category";
					$sql_query=mysqli_query($cxn, $sql);
					if(!$sql_query)
					{
						$nuts=mysqli_errno($cxn).' '.mysqli_error($cxn);
						die($nuts);
					}
					while($sql_row=mysqli_fetch_assoc($sql_query))
					{
					?>
					<option value="<?php echo $sql_row['id'];?>"><?php echo stripslashes($sql_row['category']);?></option>
					<?php
					}
					?>
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Manufacturer ID
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="mfgid" value="<?php echo stripslashes($row['mfgid']); ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Manufacturer
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="manufacturer" value="<?php echo stripslashes($row['manufacturer']); ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Distributor
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="distributor" value="<?php echo stripslashes($row['distributor']); ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Minimum Order
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="minimum_order" value="<?php echo $row['minimum_order']; ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Maximum  Order
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="maximum_order" value="<?php echo $row['maximum_order']; ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Keywords
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="keywords" value="<?php echo $row['keywords']; ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Sorting
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="sorting" value="<?php echo $row['sorting'];?>">
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;<br></td>
			</tr>
				<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Cost
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="cost" value="<?php echo stripslashes($row['cost']); ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Price
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="price" value="<?php echo $row['price']; ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Price 2
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="price2" value="<?php echo $row['price2']; ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Price 3
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="price3" value="<?php echo $row['price3']; ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Ship Cost
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="shipcost" value="<?php echo $row['shipcost'];?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Free Shipping (1=yes, 0=no)
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="free_shipping" value="<?php echo $row['free_shipping'];?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Sale Price
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="sale_price" value="<?php echo $row['sale_price']; ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				On Sale (1=yes, 0=no)
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="onsale" value="<?php echo $row['onsale']; ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Non-Tax (1=yes, 0=no)
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="non_tax" value="<?php echo $row['non_tax'];?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Not For Sale (1=yes, 0=no)
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="notforsale" value="<?php echo $row['notforsale'];?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Tax Code
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="tax_code" value="<?php echo $row['tax_code'];?>">
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;<br></td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Stock
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="stock" value="<?php echo $row['stock']; ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Stock Alert
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="stock_alert" value="<?php echo $row['stock_alert']; ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Display Stock
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="display_stock" value="<?php echo $row['display_stock']; ?>">
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;<br></td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Height
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="height" value="<?php echo $row['height'];?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Width
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="width" value="<?php echo $row['width'];?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Depth
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="depth" value="<?php echo $row['depth'];?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Weight
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="weight" value="<?php echo $row['weight']; ?>">
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;<br></td>
			</tr>			
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Image Caption 1
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="imagecaption1" value="<?php echo $row['imagecaption1']; ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Alt Title
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="title" value="<?php echo $row['title']; ?>">
				</td>
			</tr>
			<tr>
				<td class="MainText" colspan="2">
				Metatags
				</td>
			</tr>
			<tr>
				<td colspan="2">
				<textarea name="metatags"><?php echo htmlspecialchars_decode($row['metatags']); ?></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center; background-color:#cccccc;">description...</td>
			</tr>
			<tr>
				<td colspan="2">
				<textarea name="description"><?php echo stripslashes($row['description']); ?></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center; background-color:#cccccc;">extended description...</td>
			</tr>
			<tr>
				<td colspan="2">
				<textarea name="extended_description"><?php echo stripslashes($row['extended_description']); ?></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;"><input type="hidden" name="ID" value="<?php echo $row['id']; ?>"><input type="submit" value="submit"></td></form>
			</tr>
		</table>
	</td>
	<td>
	<IMG SRC="../images/spacer.gif" width="10" height="10">
	</td>
	</tr>
	</table>
</td>
</tr>
</table>
		
 <?php require_once('footer.php'); ?>	