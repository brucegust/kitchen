<?php include("header_satellite.php"); 
class GalleryPage {

	public function door_list() {
	
	global $cxn;
	
	if(isset($_GET['category']))
	{
		$sql="select * from gallery where category ='$_GET[category]' order by name";
	}
	else
	{
		$sql="select * from gallery order by name";
	}
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
		if(isset($_GET['category']))
		{
		$gallery_page = new GalleryPage();
		$gallery_title = $gallery_page->door_list();
		foreach($gallery_title as $gallery)
		{
			$the_title=stripslashes($gallery['caption']);
		}
		?>
			<span class="satellite_title"><?php echo $the_title;?></span><br><br>
		<?php
		}
		else
		{
		?>
			<span class="satellite_title">Photo Gallery</span><br><br>
		<?php
		}
		$door_page = new GalleryPage();
		$content = $door_page->door_list();
		$playlist_maxcols = 3; 
		$playlist_count=0; // initialize count
		foreach($content as $display)
		{
		$playlist_count++; // increment count
		if ($playlist_count == 1)
		 { // initalize table
		?>

		<table border="0" style="width:650px; margin:auto;">
			<tr>

			<?php
			 }
			?>

				<td style="text-align:center;">
					<table border="0" style="margin:auto;">
						<tr>
							<td style="text-align:center; padding-left:10px; padding-right:10px;">
							<?php
							if($display['url']<>"" OR $display['url']<>" " OR !empty($display['url']))
							{
							?>
								<?php
								$stunning_pic="Photos/";
								$stunning_pic.=$display['url'];
								$image    = getimagesize($stunning_pic);
								$the_width    = $image[0];
								$the_height   = $image[1];
								//$type     = $image[2];
								if($the_height>$the_width)
								{
									//portrait size
									//I want my width on my portrait size to be 200 pixels so if my ratio is height / width and my final height is 200px, then...
									$value_one=$the_width * 200;
									$value_two=round($value_one/$the_height);
									//echo $value_two;//my target width;
									?>
									<a href="#" onclick="javascript:void window.open('gallery_window.php?id=<?php echo $display['id'];?>','1435862141298','width=<?php echo $value_two; ?>,height=200,toolbar=0,menubar=0,location=0,status=0,scrollbars=0,resizable=1,left=0,top=0');return false;">
								<?php
								}
								else
								{
									//landscape size
									$value_one=$the_height*600; //my target width;
									$value_two=round($value_one/$the_width); //my target height;
								?>
									<a href="#" onclick="javascript:void window.open('gallery_window.php?id=<?php echo $display['id'];?>','1435862141298','width=600,height=<?php echo $value_two;?>,toolbar=0,menubar=0,location=0,status=0,scrollbars=0,resizable=1,left=0,top=0');return false;">
								<?php
								}
								?>
							<img src="Photos/crop.php?h=225&w=225&f=<?php echo $display['url']; ?>" border="0" alt="<?php echo $display['name']; ?>"></a>
							</td>
						</tr>
						<tr>
							<td style="text-align:center; color:#000000; font-size:10pt;">
							<?php echo stripslashes($display['name']); ?><br><br>
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

