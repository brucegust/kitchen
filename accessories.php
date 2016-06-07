<?php include("header_satellite.php"); 
class ProductPage {

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
	
	
}
?>
		<?php 
		$door_page = new ProductPage();
		$product_name=$door_page->product_name();
		?>
		<span class="satellite_title"><?php echo stripslashes($product_name); ?></span><br><br>
		<?php
		$bruce = "select * from pages where page_name='accessories_home'";
		$bruce_query=mysqli_query($cxn, $bruce);
		$bruce_row=mysqli_fetch_assoc($bruce_query);
		extract($bruce_row);
		echo stripslashes($bruce_row['body']); 
		?>
		<?php
		if (@$_SESSION['door'] == "1")                   
		{
		?>
		<br><div style="width:85%; height:auto; border:1px solid #cccccc; margin:auto; text-align:auto; box-shadow: 10px 10px 5px #cccccc; padding:10px;">If you've already selected a door and it's in your Shopping Cart, you can click on the door name below each product to proceed directly to the "features" page. In that way, you don't have to repeat the process of selecting the same door.</div><br>
		<?php
		}
		else
		{
			echo "<br><br>";
		}
		$content = $door_page->product_list();
		$playlist_maxcols = 3; 
		$playlist_count=0; // initialize count
		foreach($content as $display)
		{
		$playlist_count++; // increment count
		if ($playlist_count == 1)
		 { // initalize table
		?>

		<table border="0" style="width:600px; margin:auto;">
			<tr>

			<?php
			 }
			?>

				<td style="text-align:center;">
					<table border="0" style="margin:auto;">
						<tr>
							<td style="width:200px; height:200px; text-align:center;">
							<?php
							if($display['thumbnail']<>"" OR $display['thumbnail']<>" " OR !empty($display['thumbnail']))
							{
								$new_size=$door_page->image_fix($display['thumbnail']);
							?>
							<img src="<?php echo $display['thumbnail']; ?>" border="0" alt="<?php echo $display['name']; ?>" style="width:<?php echo $new_size;?>px; vertical-align:middle;" border="0">
							</td>
						</tr>
						<tr>
							<td><br>
							<div class="product_label">
							<b><?php echo stripslashes($product_name); ?></b><br>
							<b>Part Number:</b> <?php echo stripslashes($display['name']); ?><br>
							<b>Your Price:</b> $<?php echo $display['price']; ?></div>
							<a href="all_doors.php?product_id=<?php echo $display['id'];?>"><img src="images/select_door.png" border="0" style="margin:auto; margin-top:3px;"></a>
							</td>
						</tr>
						<?php
						if (@$_SESSION['door'] == "1")                   
						{
						$session_id=session_id();
						//echo $session_id;
						$door_shopper=shopper_alert($session_id);
							foreach($door_shopper as $shopper)
							{
							?>
							<tr>
								<td style="text-align:left;">&#9679;&nbsp;<a href="door_shop.php?door_id=<?php echo $shopper['door_table_id'];?>&product_id=<?php echo $display['id'];?>" style="color:#000000;"><?php echo $shopper['doorname'];?></a><br><br></td>
							</tr>
							<?php
							}
						}
						?>
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
		</div>
	</div>
<?php include("footer.php"); ?>

