<?php include("header_satellite.php"); ?>
		<span class="satellite_title">Customer Reviews</span><br><br>
		<?php
		$bruce = "select * from pages where page_name='reviews'";
		$bruce_query=mysqli_query($cxn, $bruce);
		$bruce_row=mysqli_fetch_assoc($bruce_query);
		extract($bruce_row);
		echo stripslashes($bruce_row['body']); 
		?><br><br>
		</div>
	</div>
<?php include("footer.php"); ?>

