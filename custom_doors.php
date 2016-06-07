<?php include("header_satellite.php"); 
class FeatureDoorPage {

	public function door_list() {
	
	global $cxn;
	
	$sql="select * from doors where featured ='0' order by name";
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
		<span class="satellite_title">Custom Doors</span><br><br>
		<?php
		$bruce = "select * from pages where page_name='custom_doors'";
		$bruce_query=mysqli_query($cxn, $bruce);
		$bruce_row=mysqli_fetch_assoc($bruce_query);
		extract($bruce_row);
		echo stripslashes($bruce_row['body']); 
		?><br><br>
		<?php
		$door_page = new FeatureDoorPage();
		$content = $door_page->door_list();
		$playlist_maxcols = 3; 
		$playlist_count=0; // initialize count
		foreach($content as $display)
		{
		$playlist_count++; // increment count
		if ($playlist_count == 1)
		 { // initalize table
		?>

		<table border="0" style="width:450px; margin:auto;">
			<tr>

			<?php
			 }
			?>

				<td style="text-align:center;">
					<table border="0" style="margin:auto;">
						<tr>
							<td style="text-align:center; padding-left:10px; padding-right:10px;">
							<?php
							if($display['image1']<>"" OR $display['image1']<>" " OR !empty($display['image1']))
							{
							?>
							<img src="assets/images/door_colors/<?php echo $display['image1']; ?>" border="0" alt="<?php echo $display['name']; ?>" style="width:225px;">
							</td>
						</tr>
						<tr>
							<td style="text-align:center; color:#000000; font-size:10pt;">
							<b><?php echo stripslashes($display['imagecaption1']); ?></b><br><br>
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

			 ?></table>
		</div>
	</div>
<?php include("footer.php"); ?>

