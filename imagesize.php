<?php
$variable = 'Photos/Ginger_Cook_Top_copy.jpg';
$image    = getimagesize($variable);
$width    = $image[0];
$height   = $image[1];
//$type     = $image[2];
if($height>$width)
{
	//portrait size
	//I want my width on my portrait size to be 200 pixels so if my ratio is height / width and my final height is 200px, then...
	$value_one=$width * 200;
	$value_two=round($value_one/$height);
	//echo $value_two;//my target width;
	?>
	<a href="#" onclick="javascript:void window.open('gallery_window.php?id=813','1435862141298','width=<?php echo $value_two; ?>,height=200,toolbar=0,menubar=0,location=0,status=0,scrollbars=0,resizable=1,left=0,top=0');return false;">
<?php
}
else
{
	//landscape size
	$value_one=$height*600; //my target width;
	$value_two=round($value_one/$width); //my target height;
?>
	<a href="#" onclick="javascript:void window.open('gallery_window.php?id=813','1435862141298','width=600,height=<?php echo $value_two;?>,toolbar=0,menubar=0,location=0,status=0,scrollbars=0,resizable=1,left=0,top=0');return false;">
<?php
}

?>



