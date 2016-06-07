<?php include("header_shop.php"); 
//when a user buys something, the "cart" opens up to the right and you'll see that content in the header_shop.php content
class ProductPage {

	public function door_list() {
	
	global $cxn;
	
	$sql="select doors.image1, doors.page, doors.id, doors.name, doors.manufacturer, doors.price, doors.free_shipping, doors.sale_price, doors.onsale, doors.multiplier, doors.part_id, doors.feature_door_id, products.id as real_id, products.categories as door_category, features.featurename as good_name 
	FROM doors 
	INNER JOIN products ON doors.part_id=products.part_id 
	INNER JOIN features ON doors.feature_door_id=features.part_number
	where doors.id='$_GET[door_id]'";
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
	
	public function big_bear_category() {
	
	global $cxn;
	
	$sql="select * from macro_categories where macro_category<>'Shipping' AND macro_category<>'RTA Cabinet Door Samples' order by id";
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
	
	
	public function category_list($macro_id) {
	
	global $cxn;
	
	$sql="select DISTINCT category from categories where macro_category_id='$macro_id' order by category";
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
	
	$sql="select * from categories where category='$category_name' order by sub_category";
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
	
	$sql="select products.id, products.part_id, products.name, products.price, products.thumbnail, products.category_id, categories.category as category_name, categories.sub_category from products INNER JOIN categories on products.category_id= categories.id where products.category_id='$_GET[category_id]'";
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
		$the_name=$row->category;
		return $the_name;
	}
	
	public function product_name() {
	
	global $cxn;
	
	$sql="select sub_category from categories where id='$_GET[category_id]'";
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
		$subcategory=$row->sub_category;
		return $subcategory;
	}
	
	public function product_info($product_id) {
		
	global $cxn;
	
	$sql="select products.part_id, products.id, products.name, products.price, products.thumbnail, products.category_id, categories.category as category_name, categories.category, categories.sub_category from products INNER JOIN categories on products.category_id=categories.id where products.id='$_GET[product_id]'";
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
	
	public function display_category_name($product_id) {
		
		global $cxn;
		
		$sql="select categories.category as category_name, categories.sub_category, categories.macro_category, categories.id as category_id from categories INNER JOIN products on products.category_id = categories.id where products.id='$product_id'";
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
	
	$sql="select * from features where product_id='$part_id' AND option_name_id<>'6' order by featurecaption, feature_sorting, sorting ASC, optionid";
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
	
	public function product_features_number($part_id) {
		
	global $cxn;
	
	$sql="select * from features where product_id='$part_id' AND sorting >'1' order by sorting DESC, feature_sorting, featurecaption";
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
		$count=mysqli_num_rows($query);
		return $count;
	}
	
	public function option_list($product_id, $optionid, $option_sorting) {
		
	global $cxn;
	
	$sql="select * from features where product_id='$product_id' and optionid='$optionid' and sorting='$option_sorting' order by feature_sorting DESC";
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
	
	public function image_fix($rough_image) {
	
		$image    = getimagesize($rough_image);
		$width    = $image[0];
		$height   = $image[1];
		//echo $width.'<br>'.$height;;
		//I've got to fit my image neatly within a 200px x 200px square, so the first thing I need to do is figure out whether my height is greater than my width of vice versa
		if($height>$width)
		{
			//portrait size
			//I want my height to be no more than 200 pixels, so...
			$calc_one=$width * 200;
			$new_width=round($calc_one/$height);
			//echo $value_two;//my target width;
		}
		else
		{
			//echo "yes";
			//landscape size
			$calc_one=$height*200; //my target width;
			$new_width=round($calc_one/$width); //my target height;
		}
		return $new_width;
	}	
	
	public function selected_door($product_id, $feature_door_id) {
		
		global $cxn;
		
		$sql="select * from features where product_id='$product_id' AND option_name_id='6' AND part_number='$feature_door_id'";
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
	
	public function next_product($product_id) {
		
		global $cxn;
		
		$new_id=$product_id+1;
		$the_name="";
		
		$sql="select part_id from products where id='$new_id'";
		//echo $sql;
		$query=$cxn->query($sql);
		$count=mysqli_num_rows($query);
		if($count>0)
		{
			$row=$query->fetch_object();
			$name=$row->part_id;
			$the_name=$name;
		}
		else
		{
			$the_name="n/a";
		}
		return $the_name;
	}
	
	public function previous_product($product_id) {
		
		global $cxn;
		
		$new_id=$product_id-1;
		$the_name="";
		
		$sql="select part_id from products where id='$new_id'";
		//echo $sql;
		$query=$cxn->query($sql);
		$count=mysqli_num_rows($query);
		if($count>0)
		{
			$row=$query->fetch_object();
			$name=$row->part_id;
			$the_name=$name;
		}
		else
		{
			$the_name="n/a";
		}
		return $the_name;
	}
	
		public function other_doors($product_id) {
		
		global $cxn;
		
		$sql="select features.part_number, features.featureprice, features.catalog_id, features.featurename, doors.id as the_door_id, doors.multiplier from features INNER JOIN doors on features.part_number=doors.feature_door_id where features.product_id='$product_id' AND features.option_name_id='6'";

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
		
		$result_array=array();
		
		while($row=$query->fetch_array())
		{
			$result_array[]=$row;
		}
		return $result_array;
	}

}
?>
<?php 
$the_door_price="";
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
	$the_multiplier=$display['multiplier'];
	$door_part_id=$display['part_id'];
	$feature_door_id=$display['feature_door_id'];
	$real_id=$display['real_id'];
	$the_category=stripslashes($display['door_category']);
	$good_name=stripslashes($display['good_name']);
	$the_display_id=$display['id'];
}
?>		
			<div style="position:absolute; width:182px; height:48px; margin-top:-45px; margin-left:320px;"><a href="all_doors.php"><img src="images/back_to_doors.jpg" border="0"></a></div><br>
			
			<!-- here is where you put your product info -->
			<?php
			if(isset($_GET['product_id'])) //you're coming from the cabinets page after the user has selected a door id and you'll also have a door id
			{
				$display_category_name=$new_door->display_category_name($_GET['product_id']);
				foreach($display_category_name as $display)
				{
					$the_macro_category=stripslashes($display['macro_category']);
					$the_category_name=stripslashes($display['category_name']);
					$the_subcategory=stripslashes($display['sub_category']);
					$the_category_id=$display['category_id'];
				}
			include("breadcrumb_map.php");
			?>
			<div style="margin-left:20px; height:26px; float:left; padding-top:5px;">
			<?php
				if($the_subcategory=="")
				{
				?>
					<a href="<?php echo $macro_url;?>" style="color:#000000;"><b><?php echo $the_macro_category;?></b></a>&nbsp;&#10148;&nbsp;<a href="<?php echo $macro_url;?>?category_id=<?php echo $the_category_id;?>" style="color:#000000;"><b><?php echo $the_category_name;?></b></a>
				<?php
				}
				else
				{
				?>
					<a href="<?php echo $macro_url;?>" style="color:#000000;"><b><?php echo $the_macro_category;?></b></a>&nbsp;&#10148;&nbsp;<b><a href="<?php echo $macro_url;?>?category_id=<?php echo $the_category_id;?>" style="color:#000000;"><?php echo $the_category_name;?></b></a>&nbsp;&#10148;&nbsp;<b><a href="<?php echo $category_url;?>?category_id=<?php echo $the_category_id;?>" style="color:#000000;"><?php echo $the_subcategory;?></b></a>
				<?php
				}
			?>
			</div>
			<div style="width:132px; height:26px; position:relative; margin-left:640px;" id="show_cart_button"><a href="#"><img src="images/view_cart.png" border="0" id="show_cart"></a></div>
			<br>
				<?php
				$product_display=$new_door->product_info($_GET['product_id']);
				foreach($product_display as $product)
				{
				?><br>
					<table border="0" style="margin:auto;">
						<tr>
							<?php
							$previous_product=$new_door->previous_product($_GET['product_id']);
							$previous_id=$_GET['product_id']-1;
							?>
							<td style="width:75px; text-align:center;"><?php if($previous_product<>"n/a"){?><a href="door_shop.php?door_id=<?php echo $_GET['door_id'];?>&product_id=<?php echo $previous_id;?>"><img src="images/left_arrow.png" border="0"></a><?php }else{?><img src="images/left_arrow.png"><?php }?><br><?php echo $previous_product;?></td>
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
							<b><?php 
							if($product['sub_category']=="")
							{
								echo stripslashes($product['category']);
							}
							else
							{
								echo stripslashes($product['sub_category']); 
							}	
							?></b><br>
							<b>Part Number:</b> <?php echo stripslashes($product['part_id']); ?><br>
							<b>Your Price:</b> $<?php 
								if($the_multiplier<>0)
								{
									$the_discount=$product['price']*($the_multiplier/100);
									$the_price=number_format(($product['price']-$the_discount), 2);
								}
								else
								{
									$the_price=number_format($product['price'],2);
								}
								echo $the_price; ?>
							</div>
							<input type="image"  src="images/select_options.png" class="button" style="margin:auto; margin-top:3px;" id="select_option">
							<!-- right in here is your hidden "box" div-->
							<div class="box">
								<!--beginning of bordered div-->
								<div style="width:580px; height:auto; margin:auto; padding:5px; margin-top:10px;">
								
									<!--beginning text and nameplate-->
									Select your cabinet options from the pulldown menu below. Then be sure to enter the quantity at the bottom. If you have any questions, be sure to contact us at  (615) 828-8377 or email: <a href="mailto:orders@onlinecabinetsdirect.com" style="color:#000000;">orders@onlinecabinetsdirect.com</a>.<br><br>
									<div style="background-color:#000000; color:#ffffff; font-weight:bold; width:560px; height:25px; margin:auto; text-align:center; padding-top:3px;"><?php echo stripslashes($product['name']);?> | <?php echo stripslashes($product['category_name']); ?> | $<?php echo $the_price;?></div><br>
									<!--end of beginning text and nameplate-->
									<form method="Post" id="myForm"><!-- this is being sent to ajax.php and you're triggering the "add_to_cart" function with the session_id-->
									<table style="width:475px; margin:auto;" border="0">
									<?php
									$current_option_id="";
									$feature_list=$new_door->product_features($product['part_id']);
									$select_count=0;
									foreach($feature_list as $feature)
									{
										if($feature['featuretype']=="DropImage" OR $feature['featuretype']=="Dropdown")
										{
										?>
											<?php if($current_option_id<>$feature['option_name_id'])
											{
											$select_count=$select_count+1;
											?>
											<tr>
												<td><b><?php echo stripslashes($feature['featurecaption']);?></b></td>
											</tr>
											<tr>
												<td><select name="select_<?php echo $select_count;?>" style="width:500px;">
												<option></option>
												<?php 
												$option_roster=$new_door->option_list($feature['product_id'], $feature['optionid'], $feature['sorting']);
												foreach($option_roster as $option)
												{
												?>
													<?php
													if($option['option_name_id']==3 OR $option['option_name_id']==12 OR $option['option_name_id']==48 OR $option['option_name_id']==9)
													{
														if($option['featureprice']==0.00)
														{
														?>
														<option value="<?php echo $option['option_name_id'].'_'.$option['id'].'_'.$option['featureprice'];?>"><?php echo stripslashes($option['featurename']);?></option>
														<?php
														}
														else
														{
														?>
														<option value="<?php echo $option['option_name_id'].'_'.$option['id'].'_'.$option['featureprice'];?>"><?php echo stripslashes($option['featurename']);?> +[$<?php echo number_format($option['featureprice'], 2);?>]</option>
														<?php
														}
													}
													else
													{
														if($option['featureprice']>0)
														{
															if($the_multiplier<>0)
															{
																$the_feature_discount=$option['featureprice']*($the_multiplier/100);
																$the_feature_price=number_format(($option['featureprice']-$the_feature_discount), 2);
															}
															else
															{
																$the_feature_price=number_format($option['featureprice'],2);
															}
														}
														else
														{
															$the_feature_price=0;
														}
														?>
													<option value="<?php echo $option['option_name_id'].'_'.$option['id'].'_'.$the_feature_price;?>">
													<?php
													if(!$the_feature_price==0.00)
													{
														echo stripslashes($option['featurename']);
													?>
													+[$<?php echo number_format($the_feature_price, 2);?>]
													<?php
													}
													else
													{
														echo stripslashes($option['featurename']);
													}
													?>
													</option>
												<?php
													}
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
									<?php 
									$royal_door=$new_door->selected_door($product['part_id'], $feature_door_id);
									if($royal_door)
									{
										foreach($royal_door as $royal)
										{
											$select_count=$select_count+1;
										?>
										<tr>
											<td><b><?php echo stripslashes($royal['featurecaption']);?></b></td>
										</tr>
										<tr>
											<td><select name="select_<?php echo $select_count;?>" style="width:500px;" disabled>
											<?php
											if($royal['featureprice']>0)
											{
												if($the_multiplier<>0)
												{
													$my_feature_discount=$royal['featureprice']*($the_multiplier/100);
													$my_feature_price=number_format(($royal['featureprice']-$my_feature_discount), 2);
												}
												else
												{
													$my_feature_price=number_format($royal['featureprice'],2);
												}
											}
											else
											{
												$my_feature_price=0;
											}
											?>
											<option selected value="<?php echo $royal['option_name_id'].'_'.$_GET['door_id'].'_'.$my_feature_price;?>">
											<?php
											if(!$my_feature_price==0.00)
											{
												echo stripslashes($royal['featurename']);
											?>
											+[$<?php echo number_format($my_feature_price, 2);?>]
											<?php
											}
											else
											{
												echo stripslashes($royal['featurename']);
											}
											?>
											</option>
										<?php
										}
										
										?>
										<!--here's where you need to put your list of all doors so user can change their finish if they want to-->
										</select><br><br>
										</td>
									</tr>
									<?php
									}
									?>
									<tr>
										<td colspan="2" style="text-align:center; background-color:#cccccc; padding:5px;"><b>quantity:</b> <input type="text" size="15" name="quantity" style="display:inline-block;"></td>
									</tr>
									</table>
								</div>
								<!--end of bordered div-->
								<br><br>
								<!-- close button -->
								<!-- the session_id is what triggers the ring_it_up / add_to_cart function on line 509 of the ajax.php page-->
								<div style="bottom:0; left:0; right:0; position:relative; padding-bottom:5px; width:248px; height:50px; text-align:center; margin:auto;"><img src="images/cancel.png" class="close_window" style="float:left;">&nbsp;&nbsp;
								<input type="hidden" name="session_id" value="<?php echo $session_id;?>">
								<input type="hidden" name="feature_door_id" value="<?php echo $_GET['door_id'];?>">
								<input type="hidden" name="door_price" value="<?php echo $my_feature_price;?>">
								<input type="hidden" name="the_count" value="<?php echo $select_count;?>">
								<input type="hidden" name="part_id" value="<?php echo $product['part_id'];?>">
								<input type="hidden" name="product_id" value="<?php echo $product['id'];?>">
								<input type="hidden" name="product_name" value="<?php echo stripslashes($product['name']);?>">
								<input type="hidden" name="price" value="<?php echo $the_price;?>">
								<input type="hidden" name="category_name" value="<?php echo stripslashes($product['category_name']); ?>">
								<input type="image" src="images/add_to_cart_button.png" style="float:left;" border="0"></a></div></form>
								<!--end of close button-->
								
							</div>
							<!-- end of hidden box div-->
							</td>
							<?php
							$next_product=$new_door->next_product($_GET['product_id']);
							$next_id=$_GET['product_id']+1;
							?>
							<td style="width:75px; text-align:center;"><?php if($next_product<>"n/a"){?><a href="door_shop.php?door_id=<?php echo $_GET['door_id'];?>&product_id=<?php echo $next_id;?>"><img src="images/right_arrow.png" border="0"></a><?php }else{?><img src="images/right_arrow.png"><?php }?><br><?php echo $next_product;?></td>
						</tr>
					</table>
				<?php
				}
			?>
			<br>
			<div style="width:100%; margin:auto; height:25px; text-align:center;">
			<?php 
			$other_guys=$new_door->other_doors($product['part_id']);
			?>
			<select name="select54" style="width:500px; border-radius:10px; font-size:10pt; background-color:#000000; color:#ffffff;" onchange="MM_jumpMenu('top',this,1)">	
			<option>Change Door / Color Finish...</option>
				<?php
				foreach($other_guys as $others)
				{
				?>
				<?php
					if($others['part_number']==$feature_door_id)
					{
						if($others['featureprice']>0)
						{
							if($the_multiplier<>0)
							{
								$door_feature_discount=$others['featureprice']*($the_multiplier/100);
								$door_feature_price=number_format(($others['featureprice']-$door_feature_discount), 2);
							}
							else
							{
								$door_feature_price=number_format($others['featureprice'],2);
							}
						}
						else
						{
							$door_feature_price=0;
						}
						if($door_feature_price>0)
						{
						?>
						<option value="door_shop.php?door_id=<?php echo $others['the_door_id'];?>&product_id=<?php echo $others['catalog_id'];?>" style="background-color:#cccccc; color:#000000;"><?php echo stripslashes($others['featurename']);?> +[$<?php echo number_format($door_feature_price, 2);?>]</option>
						<?php
						}
						else
						{
						?>
						<option value="door_shop.php?door_id=<?php echo $others['the_door_id'];?>&product_id=<?php echo $others['catalog_id'];?>" style="background-color:#cccccc; color:#000000;"><?php echo stripslashes($others['featurename']);?></option>
					<?php
						}
					}
					else
					{
						if($others['featureprice']>0)
						{
							if($others['multiplier']<>0)
							{
								$door_feature_discount=$others['featureprice']*($others['multiplier']/100);
								$door_feature_price=number_format(($others['featureprice']-$door_feature_discount), 2);
							}
							else
							{
								$door_feature_price=number_format($others['featureprice'],2);
							}
						}
						else
						{
							$door_feature_price=0;
						}
						if($door_feature_price>0)
						{
						?>
							<option value="door_shop.php?door_id=<?php echo $others['the_door_id'];?>&product_id=<?php echo $others['catalog_id'];?>"><?php echo stripslashes($others['featurename']);?> +[$<?php echo number_format($door_feature_price, 2);?>]</option>
						<?php
						}
						else
						{
						?>
							<option value="door_shop.php?door_id=<?php echo $others['the_door_id'];?>&product_id=<?php echo $others['catalog_id'];?>"><?php echo stripslashes($others['featurename']);?></option>
						<?php
						}
					}
				}
				?>
			</select>
			</div><br>
		<?php
		}
		?>
		<?php
			include("navbar_doorshop.php");
			?>
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
				<td style="vertical-align:top; text-align:center;"><span class="satellite_title"><?php echo $good_name;?></span><hr style="margin-top:-2px;"><a href="door_samples.php?id=<?php echo $the_display_id;?>"><img src="images/information_button.jpg" border="0" style="margin-top:-2px;"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="gallery.php?category=<?php echo $the_display_id;?>"><img src="images/gallery_button.jpg" border="0" style="margin-top:-2px;"></a>
			</tr>
			<tr style="height:250px;">
				<td style="vertical-align:top;"><br><ul><li><b>Name:</b> <?php echo $door_name;?></li><li><b>Your Price:</b> $<?php 
				if($sale_price>0)
				{
					$the_door_price=$sale_price;
				}
				else
				{
					$the_door_price=$the_price;	
				}
				echo $the_door_price;
				?></li></ul>
				<div style="position:relative; width:84px; height:86px; float:right; display:inline-block;"><form method="Post" id="doorForm"><input type="hidden" name="session_id" value="<?php echo $session_id;?>"><input type="hidden" name="feature_door_id" value="<?php echo $feature_door_id;?>">
				<input type="hidden" name="price" value="<?php echo $the_door_price;?>">
				<input type="hidden" name="sample_door_alert" value="1">
				<input type="hidden" name="quantity" value="1">
				<input type="hidden" name="product_id" value="<?php echo $real_id;?>">
				<input type="hidden" name="the_count" value="1">
				<input type="hidden" name="part_id" value="<?php echo $door_part_id;?>">
				<input type="hidden" name="category_name" value="<?php echo $the_category;?>">
				<input type="hidden" name="product_name" value="<?php echo $door_name;?>">
				<input type="image" src="images/add_to_cart.png"></form></div>Click on the "select options" button below to choose the features and specifications you desire for this product.<br><br><div style="text-align:center;"><b>FREE SHIPPING ON ALL DOOR SAMPLES!</b></div>				
				</td>
			</tr>
		</table>
<?php include("footer_shop.php"); ?>

