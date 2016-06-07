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
To insert a door into the database, fill in all of the fields, then click on "Submit."
<br><br>
If you want to feature this door as part of the main menu, you'll do that in the "edit" screen which you can access from the <a href="door_list.php">Door List</a>.
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
		<table width="700" class="center" border="0"><form enctype="multipart/form-data" action="door_insert_execute.php" method="post">
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Photo
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
				<input type="text" size="80" name="name">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Part ID
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="part_id">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Manufacturer ID
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="mfgid" >
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Manufacturer
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="manufacturer">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Distributor
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="distributor">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Minimum Order
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="minimum_order">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Maximum  Order
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="maximum_order">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Keywords
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="keywords">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Sorting
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="sorting">
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
				<input type="text" size="80" name="cost">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Price
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="price">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Price 2
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="price2">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Price 3
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="price3">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Ship Cost
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="shipcost">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Free Shipping (1=yes, 0=no)
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="free_shipping" value="0">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Sale Price
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="sale_price">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				On Sale (1=yes, 0=no)
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="onsale" value="0">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Non-Tax (1=yes, 0=no)
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="non_tax" value="0">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Not For Sale (1=yes, 0=no)
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="notforsale" value="0">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Tax Code
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="tax_code">
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
				<input type="text" size="80" name="stock">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Stock Alert
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="stock_alert">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Display Stock
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="display_stock">
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
				<input type="text" size="80" name="height">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Width
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="width">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Depth
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="depth">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Weight
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="weight">
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
				<input type="text" size="80" name="imagecaption1">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Alt Title
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="title">
				</td>
			</tr>
			<tr>
				<td class="MainText" background="../images/spacer.gif" width="200" height="10">
				Metatags
				</td>
				<td background="../images/spacer.gif" width="500" height="10">
				<input type="text" size="80" name="metatags">
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center; background-color:#cccccc;">description...</td>
			</tr>
			<tr>
				<td colspan="2">
				<textarea name="description"></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center; background-color:#cccccc;">extended description...</td>
			</tr>
			<tr>
				<td colspan="2">
				<textarea name="extended_description"></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;"><input type="submit" value="submit"></td></form>
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