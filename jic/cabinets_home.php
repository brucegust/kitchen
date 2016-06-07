<?php include("header_satellite.php"); 
class ProductPage {

	public function product_list() {
	
	global $cxn;
	
	$sql="select * from categories where macro_category_id='1'";
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
		<span class="satellite_title">Cabinets</span><br><br>
		<?php
		$bruce = "select * from pages where page_name='base_cabinet_pricing'";
		$bruce_query=mysqli_query($cxn, $bruce);
		$bruce_row=mysqli_fetch_assoc($bruce_query);
		extract($bruce_row);
		echo stripslashes($bruce_row['body']); 
		?><br><br>
		<?php
		$door_page=new ProductPage;
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
					<table border="0" style="margin:auto; width:200px;">
						<tr>
							<td style="text-align:center; padding-left:10px; padding-right:10px;">
							<?php
							if($display['image_path']<>"")
							{
							?>
							<a href="cabinets.php?category_id=<?php echo $display['id'];?>"><img src="<?php echo $display['image_path']; ?>" border="0" alt="<?php echo $display['category']; ?>" style="height:165px;" border="0"></a>
							<?php
							}
							else
							{
							?>
							<a href="cabinets.php?category_id=<?php echo $display['id'];?>"><img src="images/no_image_available.jpg" border="0" style="width:200px;" border="0"></a>
							<?php
							}
							?>		
							</td>
						</tr>
						<tr>
							<td><br>
							<div style="width:200px; height:auto; border:1px solid #0aa73e; border-radius:5px; margin:auto; background-color:#0aa73e; color:#ffffff; font-size:10pt; text-align:left; padding-left:5px; box-shadow: 5px 5px 5px #cccccc; text-align:center;">
							<b><?php echo stripslashes($display['category']); ?></b><br>
							</div><br>
							</td>
						</tr>
					</table>
				</td>

			<?php
			if ($playlist_count % $playlist_maxcols == 0)
			 { // if modulus of count is = 0 then end row
			echo "</tr><tr>"; 
			 }

			}

			 ?></table>
		</div>
	</div>
	<div style="background-image:url(images/satellite_text_footer.jpg); background-repeat:no-repeat; width:857px; height:25px; margin-left:72px; margin-top:-10px;"></div>
</div>
<?php include("footer.php"); ?>

