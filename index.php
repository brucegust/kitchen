<?php include("header.php"); ?>

<?php
 function ad_presence() {
	 
	 global $cxn;
	 
	 $sql="select * from ads";
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
	 
?>

<?php
$ad=ad_presence();
foreach($ad as $commercial)
{
	$yes_no=$commercial['yes_no'];
	$the_content=stripslashes($commercial['content']);
}
if($yes_no>0)
{
?>
<div class="sale_burst">
	<div class="sale_burst_message" style="color:#ffffff; font-weight:bold; text-align:center;">
	<?php echo $the_content;?>
	</div>
</div>
<?php
}
?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner">
		<div class="item active">
		<img src="images/kitchen_1.jpg">
		</div>
		<div class="item">
		<img src="images/kitchen_2.jpg" alt="">
		</div>
		<div class="item">
		<img src="images/kitchen_3.jpg" alt="">
		</div>
	</div>
</div><!-- /.carousel -->
<div class="smoke">
	<div class="cabinet_pulls">
	<a href="all_doors.php"><div class="door_sample"></div></a>
	<a href="cabinets_home.php"><div class="cabinets"></div></a>
	<a href="trim_home.php"><div class="trims"></div></a>
	<a href="all_doors.php"><div class="posts"></div></a>
	<a href="accessories_home.php"><div class="accessories"></div></a>
	</div>
</div>
<?php include("footer_index.php"); ?>