<?php include("header_satellite.php"); ?>
		<span class="satellite_title">About</span><br><br>
		<?php
		$shane="SELECT * FROM pictures order by RAND() LIMIT 1";
		$shane_query=mysqli_query($cxn, $shane);
		$shane_row=mysqli_fetch_assoc($shane_query);
		extract($shane_row);
		?>
		<a href="Photos/<?php echo $shane_row['url'];?>" target="_blank"><img src="Photos/<?php echo $shane_row['url']; ?>" border="0" style="width:250px; margin:10px; float:right;"></a>
		<?php
		$bruce = "select * from pages where page_name='about'";
		$bruce_query=mysqli_query($cxn, $bruce);
		$bruce_row=mysqli_fetch_assoc($bruce_query);
		extract($bruce_row);
		echo stripslashes($bruce_row['body']); 
		?><br>
		</div>
	</div>
<?php include("footer.php"); ?>

