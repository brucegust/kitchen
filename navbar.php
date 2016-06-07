<?php
class FeatureDoorAdmin {

	public function door_list() {
	
	global $cxn;
	
	$sql="select * from doors where featured ='1' order by name";
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

class FeatureFinishAdmin {

	public function door_list() {
	
	global $cxn;
	
	$sql="select * from gallery where featured ='1' order by caption";
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


<div class="navbar">
		<div class="navcontainer">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="#" class="restore">About</a>
					<ul>
						<li><a href="about.php">About</a></li>
						<li><a href="construction.php">Construction</a></li>
						<li><a href="about.php#specs">Specifications</a></li>
						<li><a href="why.php">Why Buy RTA Cabinets...</a></li>
						<li><a href="#" class="display_hide" style="outline:0;">Policies  &#9660;</a>
							<div class="slidingNavTerms">
								<a href="returns.php" style="line-height:26px; outline:0;">Return Policy</a>
								<a href="privacy.php" style="line-height:26px; outline:0;">Privacy Policy</a>
								<a href="damage.php" style="line-height:26px; outline:0;">Damage Policy</a>
							</div>
						</li>
					</ul>
				</li>
				<li><a href="gallery_full.php" class="restore">Gallery</a>
					<ul style="width:400px; height:auto; background-color:#ffffff;">
					<?php
					$data = new FeatureFinishAdmin();
					$content = $data->door_list();
					$playlist_maxcols = 3; 
					$playlist_count=0; // initialize count
					foreach($content as $display)
					{
					$playlist_count++; // increment count
					if ($playlist_count == 1)
					 { // initalize table
					?>
					<br>
						<table border="0" style="width:auto; margin:auto;">
						<tr>

						<?php
						 }
						?>

							<td style="text-align:center;">
								<table style="width:125px; margin:auto;" border="0">
									<tr>
										<td style="text-align:center; color:#000000; font-size:8pt;">
										<?php
										if($display['url']<>"" OR $display['url']<>" " OR !empty($display['url']))
										{
										?>
										<A HREF="gallery.php?category=<?php echo $display['category']; ?>"><img src="Photos/crop.php?h=85&w=85&f=<?php echo $display['url']; ?>"  border="0" alt="<?php echo $display['category']; ?>" style="margin-left:-28px;"></a>
										<?php echo stripslashes($display['caption']); ?>
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

						if ($playlist_count)
						{ // data exists
						 $playlist_fill = ($playlist_count % $playlist_maxcols); // current column
						if ($playlist_fill){ // if not last column already fill in blank columns
						
						
						for ($i = $playlist_fill; $i <= ($playlist_maxcols -1); $i++){
						echo "<td>&nbsp;</td>";
						}
						echo "</tr>";
						 }
						 echo "</table><br>";
						}
						?>	
					</ul>					
				</li>
				<li><a href="all_doors.php" class="restore">Door Styles</a>
					<ul style="width:480px; height:auto; background-color:#ffffff;">
					<!-- code for feature doors -->					
					<?php
					$data = new FeatureDoorAdmin();
					$content = $data->door_list();
					$playlist_maxcols = 4; 
					$playlist_count=0; // initialize count
					foreach($content as $display)
					{
					$playlist_count++; // increment count
					if ($playlist_count == 1)
					 { // initalize table
					?>
						<table border="0" style="width:450px; margin:auto;">
							<tr>
							<td colspan="4" style="padding-top:5px; padding-bottom:5px;"><a href="rta_doors.php" class="doors">view standard finishes...</a></td>
						</tr>
						<tr>
						<?php
						 }
						?>

							<td style="text-align:center;">
								<table border="0" style="margin:auto;">
									<tr>
										<td style="text-align:center;">
										<?php
										if($display['image1']<>"" OR $display['image1']<>" " OR !empty($display['image1']))
										{
										?>
										<A HREF="door_samples.php?id=<?php echo $display['id']; ?>"><img src="assets/images/door_colors/<?php echo $display['image1']; ?>" border="0" alt="<?php echo $display['name']; ?>" style="width:75px; margin-left:-22px;;"></a>
										</td>
									</tr>
									<tr>
										<td style="text-align:center; color:#000000; font-size:8pt;">
										<?php echo stripslashes($display['title']); ?>
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

						if ($playlist_count)
						{ // data exists
						 $playlist_fill = ($playlist_count % $playlist_maxcols); // current column
						if ($playlist_fill){ // if not last column already fill in blank columns
						
						
						for ($i = $playlist_fill; $i <= ($playlist_maxcols -1); $i++){
						echo "<td>&nbsp;</td>";
						}
						echo "</tr>";
						 }
						 ?>
						 <tr>
							<td colspan="4"><a href="custom_doors.php" class="doors">view custom finishes...</a></td>
						</tr>
						<?php
						 echo "</table><br>";
						}
						?>
					</ul>	
				
				</li>
				<li><a href="#" class="restore">How to Design Your Kitchen</a>
					<ul>
						<li><a href="design.php">Design</a></li>
						<li><a href="assembly.php">Assembly</a></li>
					</ul>
				</li>
				<li><a href="faqs.php" class="restore">Faqs</a></li>
				<li><a href="reviews.php" class="restore">Reviews</a></li>
				<li><a href="contact.php" class="restore">Contact</a></li>
			</ul>
		</div>	
	</div>