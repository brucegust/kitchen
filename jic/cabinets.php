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
}
?>
		<?php 
		$door_page = new ProductPage();
		$product_name=$door_page->product_name();
		?>
		<span class="satellite_title"><?php echo stripslashes($product_name); ?></span><br><br>
		<?php
		$bruce = "select * from pages where page_name='base_cabinet_pricing'";
		$bruce_query=mysqli_query($cxn, $bruce);
		$bruce_row=mysqli_fetch_assoc($bruce_query);
		extract($bruce_row);
		echo stripslashes($bruce_row['body']); 
		?><br><br>
		<?php
		
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
							<td style="text-align:center; padding-left:10px; padding-right:10px;">
							<?php
							if($display['thumbnail']<>"" OR $display['thumbnail']<>" " OR !empty($display['thumbnail']))
							{
							?>
							<img src="<?php echo $display['thumbnail']; ?>" border="0" alt="<?php echo $display['name']; ?>" style="height:180px;">
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
	<div style="background-image:url(images/satellite_text_footer.jpg); background-repeat:no-repeat; width:857px; height:25px; margin-left:72px; margin-top:-10px;"></div>
</div>
<?php include("footer.php"); ?>

