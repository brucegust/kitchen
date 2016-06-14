<tr>
<td>
	<?php
	
	$playlist_maxcols = 5; 
	/*$playlist_query = "select * from featured JOIN registration ON playlist.contestant_id = registration.id order by jukebox_hits DESC LIMIT 10";
	$playlist_result = mysqli_query($cxn, $playlist_query)*/
	$playlist_query = "select * from playlist JOIN registration on playlist.contestant_id = registration.id order by playlist.jukebox_hits DESC LIMIT 10";
	$playlist_result = mysqli_query($cxn, $playlist_query);
	if(!$playlist_result){
	$nuts=mysqli_errno($cxn).': '.mysqli_error($cxn);
	die($nuts);
	}
	$playlist_count=0; // initialize count
	while ($playlist_row=mysqli_fetch_assoc($playlist_result))
	{
	extract($playlist_row);
	$artist_photo = $glamour_shot;
	$playlist_count++; // increment count

	if ($playlist_count == 1)
	 { // initalize table
	?>

		<table border="0" width=100%>
		<tr>

		<?php
		 }
		?>

			<td class="photo_gallery">
			<?php
			if($artist_photo=="" OR $artist_photo==" " OR empty($artist_photo))
			{
			?>
			<div id="photo_gallery_container">
			<A HREF="contestant.php?id=<?php echo $contestant_id; ?>" target="_blank" class="photo"><img src="Photos/contestants/no_image.jpg" border="0" alt="<?php echo $playlist_row['stage_name']; ?>"></a>
				<div id="photo_gallery_id_np">
				<?php echo stripslashes($playlist_row['stage_name']); ?>
				</div>
			</div>
			<?php
			}
			else
			{
			?>
			<div id="photo_gallery_container">
			<A HREF="contestant.php?id=<?php echo $contestant_id; ?>" target="_blank" class="photo"><img src="Photos/contestants/crop.php?h=100&w=100&f=<?php echo $artist_photo; ?>" border="0" alt="<?php echo $playlist_row['stage_name']; ?>"></a>
				<div id="photo_gallery_id">
				<?php echo stripslashes($playlist_row['stage_name']); ?>
				</div>
			</div>
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
		 echo "</table>";
		}
		?>

</td>
</tr>