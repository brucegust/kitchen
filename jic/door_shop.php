<?php include("header_shop.php"); 
class ProductPage {

	public function door_list() {
	
	global $cxn;
	
	$sql="select * from doors where id='$_GET[door_id]'";
	//echo $sql;
		if(!$query=$cxn->query($sql))
		{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		
		$result_array = array();
		
		while($row=$query->fetch_array())
		{
			$result_array[]=$row;
		}
		return $result_array;
	}
	
	public function macro_category($id) {
		
	global $cxn;
	
	$sql="select * from macro_categories where id='$id'";
	if(!$query=$cxn->query($sql))
		{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		
		$row=$query->fetch_object();
		$the_name=$row->name;
		return $the_name;
	}
	
	public function category_list($macro_id) {
	
	global $cxn;
	
	$sql="select DISTINCT macro_category from categories where macro_category_id='$macro_id' order by macro_category";
	//echo $sql;
		if(!$query=$cxn->query($sql))
		{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		
			$result_array = array();
		
		while($row=$query->fetch_array())
		{
			$result_array[]=$row;
		}
		return $result_array;
	}
	
	public function subcategory_list($category_name) {
	
	global $cxn;
	
	$sql="select * from categories where macro_category='$category_name' order by category";
	//echo $sql;
		if(!$query=$cxn->query($sql))
		{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		
			$result_array = array();
		
		while($row=$query->fetch_array())
		{
			$result_array[]=$row;
		}
		return $result_array;
	}
	
	public function product_list() {
	
	global $cxn;
	
	$sql="select * from products where category_id='$_GET[category_id]'";
	//echo $sql;
		if(!$query=$cxn->query($sql))
		{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		
		$result_array = array();
		
		while($row=$query->fetch_array())
		{
			$result_array[]=$row;
		}
		return $result_array;
	}
	
	public function category_name($id) {
		
	global $cxn;
	
	$sql="select category from categories where id='$id'";
	if(!$query=$cxn->query($sql))
		{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		
		$row=$query->fetch_object();
		$the_name=$row->category;
		return $the_name;
	}
	
	public function product_name() {
	
	global $cxn;
	
	$sql="select category from categories where id='$_GET[category_id]'";
	//echo $sql;
		if(!$query=$cxn->query($sql))
		{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		
		$row=$query->fetch_object();
		$subcategory=$row->category;
		return $subcategory;
	}
	
	public function product_info($product_id) {
		
	global $cxn;
	
	$sql="select products.part_id, products.id, products.name, products.part_id, products.price, products.thumbnail, products.category_id, categories.category as category_name from products INNER JOIN categories on products.category_id=categories.id where products.id='$_GET[product_id]'";
	//echo $sql;
		if(!$query=$cxn->query($sql))
		{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		
		$result_array = array();
		
		while($row=$query->fetch_array())
		{
			$result_array[]=$row;
		}
		return $result_array;
	}

	public function product_features($part_id) {
		
	global $cxn;
	
	$sql="	select * from features where product_id='$part_id' AND sorting >'1' order by sorting DESC, feature_sorting";
	//echo $sql;
		if(!$query=$cxn->query($sql))
		{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		
		$result_array = array();
		
		while($row=$query->fetch_array())
		{
			$result_array[]=$row;
		}
		return $result_array;
	}
	
	public function option_list($product_id, $sorting) {
		
	global $cxn;
	
	$sql="select * from features where product_id='$product_id' and sorting='$sorting' order by feature_sorting DESC";
	//echo $sql;
		if(!$query=$cxn->query($sql))
		{
			$err='your course list didn\'t happen because: '
			.'ERRNO: '
			.$cxn->errno
			.' ERROR: '
			.$cxn->error
			.' for this query: '
			.$query
			.PHP_EOL;
			trigger_error($err, E_USER_WARNING);
		}
		
		$result_array = array();
		
		while($row=$query->fetch_array())
		{
			$result_array[]=$row;
		}
		return $result_array;
	}
		
}
?>
<?php 
$new_door=new ProductPage();
$display_door=$new_door->door_list();
foreach($display_door as $display)
{
	$door_image=$display['image1'];
	$door_text=stripslashes($display['page']);
	$gallery_id=$display['id'];
	$door_name=stripslashes($display['name']);
	$manufacturer=stripslashes($display['manufacturer']);
	$the_price=$display['price'];
	$free_shipping=$display['free_shipping'];
	$sale_price=$display['sale_price'];
	$on_sale=$display['onsale'];
}
?>		
			<div style="position:absolute; width:182px; height:48px; margin-top:-45px; margin-left:320px;"><a href="all_doors.php"><img src="images/back_to_doors.jpg" border="0"></a></div><br>
			<table style="width:700px; margin:auto;" border="0">
				<tr>
					<td style="text-align:center;" rowspan="2"><img src="assets/images/door_colors/<?php echo $door_image; ?>" style="width:225px;">
					<?php
					if($on_sale>0)
					{
					?>
					<div style="position:absolute; margin-top:-250px; margin-left:52px; width:125px; height:120px; background-image:url(images/for_sale.png); background-repeat:no-repeat;">
					<!--here's where my "on sale" numbers go-->
						<div style="color:#ffffff; width:75px; height:18px; margin-top:50px; text-align:center; margin-left:20px;"><strike>$<?php echo number_format($the_price);?></strike></div> 
						<div style="color:#ffffff; width:65px; height:24px; font-size:12pt; font-weight:bold; margin-top:-2px; margin-left:24px; text-align:center;">$<?php echo number_format($sale_price);?></div> 
					</div>
					<?php
					}
					?>
					<?php if($free_shipping==1)
					{ 
					?>
					<div style="position:absolute; width:96px; height:78px; margin-top:-75px; margin-left:135px;"><img src="images/free_shipping.png"></div>
					<?php 
					} 
					?></td>
					<td style="vertical-align:top; text-align:center;"><span class="satellite_title"><?php echo $door_name;?></span><hr style="margin-top:-2px;"><a href="door_samples.php?id=<?php echo $display['id'];?>"><img src="images/information_button.jpg" border="0" style="margin-top:-2px;"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="gallery.php?category=<?php echo $display['id'];?>"><img src="images/gallery_button.jpg" border="0" style="margin-top:-2px;"></a>
				</tr>
				<tr style="height:250px;">
					<td style="vertical-align:top;"><br><ul><li><b>Name:</b> <?php echo $door_name;?></li><li><b>Manufacturer:</b> <?php echo $manufacturer; ?></li><li><b>Your Price:</b> $<?php 
					if($sale_price>0)
					{
						echo $sale_price; 
					}
					else
					{
						echo $the_price;	
					}
					?></li></ul>
					<div style="position:relative; width:84px; height:86px; float:right;"><img src="images/add_to_cart.png"></div>Choose from the pulldowns to begin building your dream collection of cabinetry!<br><br><div style="text-align:center;"><b>FREE SHIPPING ON ALL DOOR SAMPLES!</b></div>				
					</td>
				</tr>
			</table>
			<div class="shop_navbar">
				<div class="shop_navbar_container">
					<ul>
						<li><a href="#">Cabinets &#9660;</a>
							<ul>
							<?php
							$macro_list=$new_door->category_list("1");
							foreach($macro_list as $macro)
							{
							?>
								<li><a href="#"><?php echo stripslashes($macro['macro_category']);?></a>
									<ul>
									<?php
									$sub_list=$new_door->subcategory_list($macro['macro_category']);
									foreach($sub_list as $sub)
									{
									?>
										<li><a href="door_shop.php?category_id=<?php echo $sub['id'];?>&door_id=<?php echo $_GET['door_id'];?>"><?php echo stripslashes($sub['category']);?></a></li>
									<?php
									}
									?>
									</ul>
								</li>
							<?php
							}
							?>
							</ul>
						</li>
						<li><a href="#">Trim & Details &#9660;</a></li>
						<li><a href="#">Posts, Corbels & Onlays &#9660;</a></li>
						<li><a href="#">Accessories &#9660;</a></li>
					</ul>
				</div>
			</div><!-- this concludes your product nav bar-->
			<!-- here is where you put your product info -->
			<?php 
				/*what you display at this point on the page depends on what you have in your URL. You'll have a category_id if the user has already selected a door and you're coming from that particular door's page. You'll have a product id if it's coming the cabinets page
				*/
				if(isset($_GET['category_id']))
				{
					$the_category_name=$new_door->product_name();
					$product_grid=$new_door->product_list();
					$playlist_maxcols = 3; 
					$playlist_count=0; // initialize count
					foreach($product_grid as $grid)
					{
					$playlist_count++; // increment count
					$your_category=$new_door->category_name($grid['category_id']);
					if ($playlist_count == 1)
					{ // initalize table
					?><br>
					<table border="0" style="width:600px; margin:auto;"><!--this is that "main grid," if you will. This is where you're putting all of your info-->
						<tr>
						<?php
						 }
						?>
							<td style="text-align:center;">
								<table border="0" style="margin:auto;">
									<tr>
										<td style="text-align:center; padding-left:10px; padding-right:10px;">
										<?php
										if($grid['thumbnail']<>"")
										{
										?>
										<img src="<?php echo $grid['thumbnail']; ?>" border="0" alt="<?php echo $grid['name']; ?>" style="height:180px;">
										</td>
									</tr>
									<tr>
										<td><br>
										<div class="product_label">
										<b><?php echo stripslashes($the_category_name); ?></b><br>
										<b>Part Number:</b> <?php echo stripslashes($grid['name']); ?><br>
										<b>Your Price:</b> $<?php echo $grid['price']; ?></div>
										<input type="image"  src="images/select_options.png" class="button" style="margin:auto; margin-top:3px;">
										<div class="box">
											<!--beginning of bordered div-->
											<div style="width:580px; height:auto; margin:auto; border:1px solid #cccccc; padding:5px; margin-top:10px; border-radius:10px;">
											
												<!--beginning text and nameplate-->
												Select your cabinet options from the pulldown menu below. Then be sure to enter the quantity at the bottom. If you have any questions, be sure to contact us at  (615) 828-8377 or email: <a href="mailto:orders@onlinecabinetsdirect.com" style="color:#000000;">orders@onlinecabinetsdirect.com</a>.<br><br>
												<div style="background-color:#000000; color:#ffffff; font-weight:bold; width:560px; height:25px; margin:auto; text-align:center; padding-top:3px;"><?php echo stripslashes($grid['name']);?> | <?php echo stripslashes($the_category_name); ?> | $<?php echo $grid['price'];?></div><br>
												<!--end of beginning text and nameplate-->
												<table style="width:475px; margin:auto;" border="0">
												<?php
												$current_option_id="";
												$feature_list=$new_door->product_features($grid['part_id']);
												foreach($feature_list as $feature)
												{
													if($feature['featuretype']=="DropImage" OR $feature['featuretype']=="Dropdown")
													{
													?>
														<?php if($current_option_id<>$feature['option_name_id'])
														{
														?>
														<tr>
															<td><b><?php echo stripslashes($feature['featurecaption']);?></b></td>
														</tr>
														<tr>
															<td><select name="<?php echo stripslashes($feature['featurename']);?>" style="width:450px;">
															<option></option>
															<?php 
															$option_roster=$new_door->option_list($feature['product_id'], $feature['sorting']);
															foreach($option_roster as $option)
															{
															?>
															<option value="<?php echo $option['id'];?>"><?php echo stripslashes($option['featurename']);?></option>
															<?php
															}
															?>
															</select>
															<br><br></td>
														</tr>
														<?php
														}
													}
													$current_option_id=$feature['option_name_id'];
												}
												?>
												
												</table>
											</div>
											<!--end of bordered div-->
											
											<!-- close button -->
											<div style="bottom:0; left:0; right:0; position:absolute; padding-bottom:5px; width:248px; height:50px; text-align:center; margin:auto;"><input type="image" src="images/cancel.png" class="close_window" style="float:left;">&nbsp;&nbsp;<a href="#" class="menu_toggle"><img src="images/add_to_cart_button.png" style="float:left;" border="0"></div>
											<!--end of close button-->
											
										</div>
										<!--end of hidden box div-->
										</td>
									</tr>
								</table>
							<?php
							}
							?>
							</td>

						<?php
						if ($playlist_count % $playlist_maxcols == 0)
						 { // if modulus of count is = 0 then end row
						echo "</tr><tr>"; 
						 }
					}
				 ?></table><br>
			<?php
			}
			?>
			<?php
			if(isset($_GET['product_id'])) //you're coming from the cabinets page after the user has selected a door id and you'll also have a door id
			{
				$product_display=$new_door->product_info($_GET['product_id']);
				foreach($product_display as $product)
				{
				?><br>
					<table border="0" style="margin:auto;">
						<tr>
							<td style="text-align:center; padding-left:10px; padding-right:10px;">
							<?php
							if($product['thumbnail']<>"")
							{
							?>
							<img src="<?php echo $product['thumbnail']; ?>" border="0" alt="<?php echo $product['name']; ?>" style="height:180px;">
							<?php
							}
							else
							{
							?>
							<img src="images/no_image_available.jpg" border="0" style="height:180px;" border="0">
							<?php
							}
							?>		
							</td>
							<td><br>
							<div class="product_label">
							<b><?php echo stripslashes($product['category_name']); ?></b><br>
							<b>Part Number:</b> <?php echo stripslashes($product['part_id']); ?><br>
							<b>Your Price:</b> $<?php echo $product['price']; ?>
							</div>
							<input type="image"  src="images/select_options.png" class="button" style="margin:auto; margin-top:3px;">
							<!-- right in here is your hidden "box" div-->
							<div class="box">
								<!--beginning of bordered div-->
								<div style="width:580px; height:auto; margin:auto; border:1px solid #cccccc; padding:5px; margin-top:10px; border-radius:10px;">
								
									<!--beginning text and nameplate-->
									Select your cabinet options from the pulldown menu below. Then be sure to enter the quantity at the bottom. If you have any questions, be sure to contact us at  (615) 828-8377 or email: <a href="mailto:orders@onlinecabinetsdirect.com" style="color:#000000;">orders@onlinecabinetsdirect.com</a>.<br><br>
									<div style="background-color:#000000; color:#ffffff; font-weight:bold; width:560px; height:25px; margin:auto; text-align:center; padding-top:3px;"><?php echo stripslashes($product['name']);?> | <?php echo stripslashes($product['category_name']); ?> | $<?php echo $product['price'];?></div><br>
									<!--end of beginning text and nameplate-->
									<table style="width:475px; margin:auto;" border="0">
									<?php
									$current_option_id="";
									$feature_list=$new_door->product_features($product['part_id']);
									foreach($feature_list as $feature)
									{
										if($feature['featuretype']=="DropImage" OR $feature['featuretype']=="Dropdown")
										{
										?>
											<?php if($current_option_id<>$feature['option_name_id'])
											{
											?>
											<tr>
												<td><b><?php echo stripslashes($feature['featurecaption']);?></b></td>
											</tr>
											<tr>
												<td><select name="<?php echo stripslashes($feature['featurename']);?>" style="width:450px;">
												<option></option>
												<?php 
												$option_roster=$new_door->option_list($feature['product_id'], $feature['sorting']);
												foreach($option_roster as $option)
												{
												?>
												<option value="<?php echo $option['id'];?>"><?php echo stripslashes($option['featurename']);?></option>
												<?php
												}
												?>
												</select>
												<br><br></td>
											</tr>
											<?php
											}
										}
										$current_option_id=$feature['option_name_id'];
									}
									?>
									
									</table>
								</div>
								<!--end of bordered div-->
								
								<!-- close button -->
								<div style="bottom:0; left:0; right:0; position:absolute; padding-bottom:5px; width:248px; height:50px; text-align:center; margin:auto;"><input type="image" src="images/cancel.png" class="close_window" style="float:left;">&nbsp;&nbsp;<a href="#catalog_top" class="menu_toggle"><img src="images/add_to_cart_button.png" style="float:left;" border="0"></div>
								<!--end of close button-->
								
							</div>
							<!-- end of hidden box div-->
							</td>
						</tr>
					</table>
				<?php
				}
			}
			?>
<?php include("footer_shop.php"); ?>

