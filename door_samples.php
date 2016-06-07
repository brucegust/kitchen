<?php include("header_satellite.php"); 
class GalleryPage {

	public function door_list() {
	
	global $cxn;
	
	$sql="select * from doors where id='$_GET[id]'";

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
		$gallery_page = new GalleryPage();
		$gallery_title = $gallery_page->door_list();
		foreach($gallery_title as $gallery)
		{
			$the_title=stripslashes($gallery['name']);
			$the_page=stripslashes($gallery['page']);
		}
		?>
		<?php echo stripslashes($the_page); ?><br><br>
		</div>
	</div>
<?php include("footer.php"); ?>

