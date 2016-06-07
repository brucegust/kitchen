<?php

session_start(); 
if (@$_SESSION['auth'] != "yes")                   
{
header("Location: default.php");
exit();
}
$photo_presence=0;
$flag=0;
$shy=0;
$photo_there=0;
include ("../carter.inc");

$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");

if(!empty($_POST['hidden'])){
$shy=1;
//here's where I'm checking to see if the featured box is checked and if it is, I update with a "Y" value
$featured_contestant = "UPDATE products SET hidden='1' where id='$_POST[ID]'";
$featured_contestant_result = mysqli_query($cxn, $featured_contestant);
}
else
{
$shy=0;
//just in case it had been populated before, we go ahead and update it to a null value so we can remove the featured option if need be
$featured_contestant = "UPDATE products SET hidden='0' where id='$_POST[ID]'";
$featured_contestant_result = mysqli_query($cxn, $featured_contestant);
}


$name = mysqli_real_escape_string($cxn, trim($_POST['name']));
$part_id=trim($_POST['part_id']);
$mfgid=trim($_POST['mfgid']);
$manufacturer = mysqli_real_escape_string($cxn, trim($_POST['manufacturer']));
$distributor = mysqli_real_escape_string($cxn, trim($_POST['distributor']));
$minimum_order=trim($_POST['minimum_order']);
$maximum_order=trim($_POST['maximum_order']);
$keywords = mysqli_real_escape_string($cxn, trim($_POST['keywords']));
$sorting=trim($_POST['sorting']);

$cost=trim($_POST['cost']);
$price=trim($_POST['price']);
$price2=trim($_POST['price2']);
$price3=trim($_POST['price3']);
$shipcost=trim($_POST['shipcost']);
$free_shipping=trim($_POST['free_shipping']);
$sale_price=trim($_POST['sale_price']);
$onsale=trim($_POST['onsale']);
$non_tax=trim($_POST['non_tax']);
$notforsale=trim($_POST['notforsale']);
$tax_code=trim($_POST['tax_code']);

$stock=trim($_POST['stock']);
$stock_alert=trim($_POST['stock_alert']);
$display_stock=trim($_POST['display_stock']);

$height = mysqli_real_escape_string($cxn, trim($_POST['height']));
$width = mysqli_real_escape_string($cxn, trim($_POST['width']));
$depth = mysqli_real_escape_string($cxn, trim($_POST['depth']));
$weight = mysqli_real_escape_string($cxn, trim($_POST['weight']));

$imagecaption1 = mysqli_real_escape_string($cxn, trim($_POST['imagecaption1']));
$title = mysqli_real_escape_string($cxn, trim($_POST['title']));
$metatags = mysqli_real_escape_string($cxn, trim($_POST['metatags']));

$description = mysqli_real_escape_string($cxn, trim($_POST['description']));
$extended_description = mysqli_real_escape_string($cxn, trim($_POST['extended_description']));

$page = mysqli_real_escape_string($cxn, trim($_POST['page']));


$query = "UPDATE products SET name='$name',
part_id='$part_id',
mfgid='$mfgid',
manufacturer='$manufacturer',
distributor='$distributor',
minimum_order='$minimum_order',
maximum_order='$maximum_order',
keywords='$keywords',
sorting='$sorting',
cost='$cost',
price='$price',
price2='$price2',
price3='$price3',
shipcost='$shipcost',
free_shipping='$free_shipping',
sale_price='$sale_price',
onsale='$onsale',
non_tax='$non_tax',
notforsale='$notforsale',
tax_code='$tax_code',
stock='$stock',
stock_alert='$stock_alert',
display_stock='$display_stock',
height='$height',
width='$width',
depth='$depth',
weight='$weight',
imagecaption1='$imagecaption1',
title='$title',
metatags='$metatags',
description='$description',
page='$page',
extended_description='$extended_description'
where id = '$_POST[ID]'";

//echo $query;

$result = mysqli_query($cxn, $query);
if (!$result = mysqli_query($cxn, $query)) {
$error = mysql_errno() . mysql_error();
die($error);
}

if(isset($_FILES['photo']) && !empty($_FILES['photo']['name']))
{
$photo_presence=1;
//echo $photo_presence;
require_once('product_photo_edit_script.php');
} 

$bruce= "select image1 from products where id = '$_POST[ID]'";
$bruce_query=mysqli_query($cxn, $bruce);
if (!$bruce_query = mysqli_query($cxn, $bruce)) {
$error = mysql_errno() . mysql_error();
die($error);
}

$bruce_row=mysqli_fetch_assoc($bruce_query);
extract($bruce_row);
if($bruce_row['image1']=="" OR $bruce_row['image1']==" " OR empty($bruce_row['image1']))
{
$photo_there=0;
}
else
{
$photo_there=1;
}



require_once('header.php');
 
?>


<table border="0" cellspacing="0" cellpadding="0" width=100%>
	<tr>
		<td class="TitleText">
		<b>Product Edit Page</b>
		</td>
		</tr>
		<tr>
		<td>&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td class="MainText">
		<P>
		Here's the product you just edited. To make any addtional changes, click on the "Back" button of your browser and repeat the process. Otherwise, to return to the Product List, click <A HREF="product_list.php">here</a>.
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
			<table width="700" align="center" border="0">
				<tr>
					<td style="background-color:#cccccc; text-align:right;" colspan="2">
						<table align="right">
							<tr>
								<td align="right">
								Hidden
								&nbsp;
								</td>
								<td>
								<?php 
								if($shy>0)
								{
								?>
								<input type="checkbox" value="Y" name="hidden" checked>
								<?php
								}
								else
								{
								?>
								<input type="checkbox" value="Y" name="hidden">
								<?php
								}
								?>
								</td>
							</tr>		
						</table>
					</td>
				</tr>
			<tr>
				<?php 
				if($photo_there>0)
				{
				?>
				<tr>
					<td class="MainText" colspan="2">
					<a href="../assets/images/<?php echo $image1; ?>" target="_blank" style="color:#000000;">Photo
					</td>
				</tr>
				<?php
				}
				?>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Name
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="name" value="<?php echo stripslashes($_POST['name']); ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Part ID
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="part_id" value="<?php echo stripslashes($_POST['part_id']); ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Manufacturer ID
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="mfgid" value="<?php echo stripslashes($_POST['mfgid']); ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Manufacturer
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="manufacturer" value="<?php echo stripslashes($_POST['manufacturer']); ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Distributor
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="distributor" value="<?php echo stripslashes($_POST['distributor']); ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Minimum Order
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="minimum_order" value="<?php echo $_POST['minimum_order']; ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Maximum  Order
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="maximum_order" value="<?php echo $_POST['maximum_order']; ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Keywords
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="keywords" value="<?php echo $_POST['keywords']; ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Sorting
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="sorting" value="<?php echo $_POST['sorting'];?>">
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
					<input type="text" size="80" name="cost" value="<?php echo stripslashes($_POST['cost']); ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Price
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="price" value="<?php echo $_POST['price']; ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Price 2
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="price2" value="<?php echo $_POST['price2']; ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Price 3
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="price3" value="<?php echo $_POST['price3']; ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Ship Cost
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="shipcost" value="<?php echo $_POST['shipcost'];?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Free Shipping (1=yes, 0=no)
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="free_shipping" value="<?php echo $_POST['free_shipping'];?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Sale Price
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="sale_price" value="<?php echo $_POST['sale_price']; ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					On Sale (1=yes, 0=no)
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="onsale" value="<?php echo $_POST['onsale']; ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Non-Tax (1=yes, 0=no)
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="non_tax" value="<?php echo $_POST['non_tax'];?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Not For Sale (1=yes, 0=no)
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="notforsale" value="<?php echo $_POST['notforsale'];?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Tax Code
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="tax_code" value="<?php echo $_POST['tax_code'];?>">
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
					<input type="text" size="80" name="stock" value="<?php echo $_POST['stock']; ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Stock Alert
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="stock_alert" value="<?php echo $_POST['stock_alert']; ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Display Stock
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="display_stock" value="<?php echo $_POST['display_stock']; ?>">
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
					<input type="text" size="80" name="height" value="<?php echo $height;?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Width
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="width" value="<?php echo $_POST['width'];?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Depth
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="depth" value="<?php echo $_POST['depth'];?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Weight
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="weight" value="<?php echo $_POST['weight']; ?>">
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
					<input type="text" size="80" name="imagecaption1" value="<?php echo $_POST['imagecaption1']; ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Alt Title
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="title" value="<?php echo $_POST['title']; ?>">
					</td>
				</tr>
				<tr>
					<td class="MainText" background="../images/spacer.gif" width="200" height="10">
					Metatags
					</td>
					<td background="../images/spacer.gif" width="500" height="10">
					<input type="text" size="80" name="metatags" value="<?php echo $_POST['metatags']; ?>">
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center; background-color:#cccccc;">description...</td>
				</tr>
				<tr>
					<td colspan="2">
					<textarea name="description"><?php echo stripslashes($_POST['description']); ?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center; background-color:#cccccc;">extended description...</td>
				</tr>
				<tr>
					<td colspan="2">
					<textarea name="extended_description"><?php echo stripslashes($_POST['extended_description']); ?></textarea>
					</td>
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
			
				

