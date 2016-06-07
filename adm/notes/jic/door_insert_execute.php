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
$headline = mysqli_real_escape_string($cxn, trim($_POST['featurename']));
//this is to compensate for the way tinymce introduces <P> tags...

$date=date("Y-m-d");

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

$double_height=str_replace("\"", "&quot;", trim($_POST['height']));
$height.=str_replace("'", "&#8217", $double_height);

$width = htmlentities(trim($_POST['width']) , ENT_QUOTES, "UTF-8");
$depth = htmlentities(trim($_POST['depth']) , ENT_QUOTES, "UTF-8");
$weight = htmlentities(trim($_POST['weight']) , ENT_QUOTES, "UTF-8");


$imagecaption1 = mysqli_real_escape_string($cxn, trim($_POST['imagecaption1']));
$title = mysqli_real_escape_string($cxn, trim($_POST['title']));
$metatags = mysqli_real_escape_string($cxn, trim($_POST['metatags']));

$description = mysqli_real_escape_string($cxn, trim($_POST['description']));
$extended_description = mysqli_real_escape_string($cxn, trim($_POST['extended_description']));

$insert = "insert into doors (part_id, name, mfgid, manufacturer, distributor, cost, price, price2, price3, sale_price, onsale, stock, weight, minimum_order, maximum_order, date_created, description, extended_description, keywords, sorting, shipcost, metatags, free_shipping, non_tax, tax_code, height, width, depth) values ('$part_id', '$name', '$mfgid', '$manufacturer', '$distributor', '$cost', '$price', '$price2', '$price3', '$sale_price', '$onsale', '$stock', '$weight', '$minimum_order', '$maximum_order', '$today', '$description', '$extended_description', '$keywords', '$sorting', '$shipcost', '$metatags', '$free_shipping', '$non_tax', '$tax_code', '$height', '$width', '$depth')";
//echo $insert;
$insertexe = mysqli_query($cxn, $insert);
if(!$insertexe)
{
	$whoops = mysqli_errno($cxn).' '.mysqli_error($cxn);
	die($whoops);
}
$novie_id = $cxn->insert_id;
if(isset($_FILES['photo']) && !empty($_FILES['photo']['name']))
{
$photo_presence=1;
require_once('door_photo_insert_script.php');
} 
require_once('header.php');
?>
	

<table border="0" cellspacing="0" cellpadding="0" width="800" class="center">
<tr>
<td class="TitleText">
<b>Door Insert Page</b>
</td>
</tr>
<tr>
<td>&nbsp;<BR>
</td>
</tr>
<tr>
<td class="MainText">
<P>
Here's the door you just entered into the database. To make any changes, click <A HREF="door_list.php">here</a>, or to add another door, click <A HREF="door_insert.php">here</a>.
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
			<table width="700" class="center" border="0"><form enctype="multipart/form-data" action="door_insert_execute.php" method="post">
			<?php 
			if($photo_presence>0)
			{
			?>
			<tr>
				<td class="MainText" colspan="2">
				<a href="../assets/images/door_colors/<?php echo $url; ?>" target="_blank" style="color:#000000;">Photo
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
				<td colspan="2">&nbsp;<br></td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Height
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="height" value="<?php echo $_POST['height'];?>">
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
		
 <?php require_once('footer.php'); ?>	
		